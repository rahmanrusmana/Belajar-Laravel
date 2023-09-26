<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\file;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\BookException;
use App\Models\BorrowLog;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookExport;
use App\Exports\bookTemplate;
use App\Imports\BooksImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use App\Models\Author;
use App\Http\Requests\ExportRequest;
use App\Http\Requests\ImportExcelRequest;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author');
            return DataTables::of($books)
                ->addColumn('action', function ($book) {
                    return view('datatable._action', [
                        'model' => $book,
                        'form_url' => route('books.destroy', $book->id),
                        'edit_url' => route('books.edit', $book->id),
                        'confirm_message' => 'Apakah Anda yakin ingin menghapus ' . $book->title . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Judul'])
            ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => 'Jumlah'])
            ->addColumn(['data' => 'author.name', 'name' => 'author.name', 'title' => 'Penulis'])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'orderable' => false, 'title' => '', 'searchable' => false
            ]);

        return view('books.index')->with(compact('html'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $bookData = $request->except('cover');

        if ($request->hasFile('cover')) {
            $uploadedCover = $request->file('cover');
            $extension = $uploadedCover->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;

            $destinationPath = public_path('img');
            $uploadedCover->move($destinationPath, $filename);

            $bookData['cover'] = $filename;
        }

        $book = Book::create($bookData);

        $message = "Berhasil menyimpan $book->title";

        if (!$request->hasFile('cover')) {
            $message .= " tanpa cover";
        }

        session()->flash("flash_notification", [
            'level' => 'success',
            'message' => $message
        ]);

        return redirect()->route('books.index');
    }

    public function edit(string $id)
    {

        $book = Book::find($id);
        return view('books.edit')->with(compact('book'));
    }


    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        if (!$book->update($request->all())) return redirect()->back();

        if ($request->hasFile('cover')) {
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $exetension = $uploaded_cover->getClientOriginalExtension();

            $filename = md5(time()) . '.' . $exetension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

            $uploaded_cover->move($destinationPath, $filename);

            if ($book->cover) {
                $old_cover =  $book->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $book->cover;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah di hapus tidak ada
                }
            }

            $book->cover = $filename;
            $book->save();
        }

        Session::flash("flash_notification", [
            'level' => 'success',
            "message" => "Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }


    public function destroy(Request $request, string $id)
    {
        $book = Book::find($id);
        $cover = $book->cover;
        if (!$book->delete()) return redirect()->back();
        if ($request->ajax()) return response()->json(['id' => $id]);

        if ($cover) {
            $old_cover = $book->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $book->cover;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
            }
        }
        $book->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Buku berhasil dihapus"
        ]);

        return redirect()->route('books.index');
    }

    public function borrow($id)
    {
        if (Auth::user() != null) {
            try {
                $book = Book::findOrFail($id);
                Auth::user()->borrow($book);
                Session::flash("flash_notification", [
                    "level" => "success",
                    "message" => "Berhasil meminjam $book->title"
                ]);
            } catch (BookException $e) {
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $e->getMessage()
                ]);
            } catch (ModelNotFoundException $e) {
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => "Buku tidak ditemukan."
                ]);
            }

            return redirect('/');
        } else {
            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Mohon Login Terlebih Dahulu"
            ]);
            return redirect('/login');
        }
    }

    public function returnBack($book_id)
    {
        $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
            ->where('book_id', $book_id)
            ->where('is_returned', 0)
            ->first();

        if ($borrowLog) {
            $borrowLog->is_returned = true;
            $borrowLog->save();

            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil mengembalikan " . $borrowLog->book->title
            ]);
        }
        return redirect('/home');
    }

    public function export()
    {
        return view('books.export');
    }


    public function exportPost(ExportRequest $request)
    {
        $authorIds = $request->input('author_id');
        $type = $request->input('type');

        $books = Book::whereIn('id', $authorIds)->get();

        if ($type == 'xls') {
            return Excel::download(new BookExport($books), 'data_buku.xlsx');
        } elseif ($type == 'pdf') {
            return $this->exportPdf($books);
        }
    }

    private function exportPdf($book = null)
    {
        $pdf = Pdf::loadView('pdf.books', compact('book'));
        return $pdf->download('buku.pdf');
    }

    public function generateExcelTemplate()
    {
        return Excel::download(new bookTemplate(), 'template-buku.xls');
    }

    public function importExcel(ImportExcelRequest $request)
    {
        $excel = $request->file('excel');
        $excels = Excel::toArray(new BooksImport(), $excel)[0];
        $rowRules = [
            'judul' => 'required',
            'penulis' => 'required',
            'jumlah' => 'required'
        ];

        $books_id = [];
        foreach ($excels as $row) {
            $validator = Validator::make($row, $rowRules);
            if ($validator->fails()) continue;
            $author = Author::firstOrCreate(['name' => $row['penulis']]);
            $book = Book::create([
                'title' => $row['judul'],
                'author_id' => $author->id,
                'amount' => $row['jumlah']
            ]);
            array_push($books_id, $book->id);
        }

        $books = Book::whereIn('id', $books_id)->get();
        if ($books->count() == 0) {
            session()->flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }

        session()->flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $books->count() . " buku."
        ]);

        return view('books.import-review')->with(compact('books'));
    }
}
