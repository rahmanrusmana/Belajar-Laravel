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

use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    public function store(StoreBookRequest $request)
    {
        //
        // $this->validate($request, [
        //     'title' => 'required|unique:books,title',
        //     'author_id' => 'required|exists:authors,id',
        //     'amount' => 'required|numeric',
        //     'cover' => 'nullable|image|max:2048'
        // ]);

        $book = Book::create($request->except('cover'));

        // isi field cover jika ada cover yang di upload
        if ($request->hasFile('cover')) {
            // mengambil file yang di upload
            $uploaded_cover = $request->file('cover');

            // mengambil extension file
            $exetension = $uploaded_cover->getClientOriginalExtension();

            // membuat nama file random berikut eztensionnya
            $filename = md5(time()) . '.' . $exetension;

            // menyimpan cover ke public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_cover->move($destinationPath, $filename);

            // mengisi field di book dengan filename yang baru di buat
            $book->cover = $filename;
            $book->save();
        } else {
            Session::flash("flash_notification", [
                'level' => 'success',
                'message' => "Berhasil menyimpan $book->title tanpa cover"
            ]);

            return redirect()->route('books.index');
        }

        Session::flash("flash_notification", [
            'level' => 'success',
            'message' => "Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        return view('books.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    public function update(UpdateBookRequest $request, $id)
    {
        // 
        // $this->validate($request, [
        //     'title' => 'required|unique:books,title,'. $id,
        //     'author_id' => 'required|exists:authors,id',
        //     'amount' => 'required|numeric',
        //     'cover' => 'nullable|image|max:2048'
        // ]);

        $book = Book::find($id);
        // $book->update($request->all());
        if (!$book->update($request->all())) return redirect()->back();

        if ($request->hasFile('cover')) {
            // mengambil cover yang di upload berikut extencion
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $exetension = $uploaded_cover->getClientOriginalExtension();

            // membuat file random  dengan extencion
            $filename = md5(time()) . '.' . $exetension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

            // memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath, $filename);

            // hapus cover lama jika ada
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        $book = Book::find($id);
        $cover = $book->cover;
        if (!$book->delete()) return redirect()->back();

        // handle hapus buku via ajax
        if ($request->ajax()) return response()->json(['id' => $id]);

        // hapus cover lama, jika ada
        // if ($book->cover) {
        if ($cover) {
            $old_cover = $book->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $book->cover;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
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
        try {
            $book = Book::findOrFail($id);
            // BorrowLog::create([
            //     'user_id' => Auth::user()->id,
            //     'book_id' => $id
            // ]);
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


    public function exportPost(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required',
            'type' => 'required|in:pdf,xls'
        ], [
            'author_id.required' => 'Anda Belum Memilih Penulis, Pilih Lah MInimal 1'
        ]);
        $books = Book::whereIn('id', $request->get('author_id'))->get();

        $handler = 'export' . ucfirst($request->get('type'));

        if ($request->get('type') == 'xls')
            return Excel::download(new BookExport($books), 'data_buku.xlsx');

        elseif ($request->get('type') == 'pdf') {
            return $this->exportPdf($books);
        }
        // return Excel::download(new BookExport($books), 'data_buku.xlsx');
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

    public function importExcel(Request $request)
    {
        // validasi untuk memastikan file yang diupload adalah excel
        $this->validate($request, ['excel' => 'required|mimes:xls,xlsx']);
        // ambil file yang baru diupload
        $excel = $request->file('excel');
        // baca sheet pertama
        $excels = Excel::toArray(new BooksImport(), $excel)[0];
        // rule untuk validasi setiap row pada file excel
        $rowRules = [
            'judul' => 'required',
            'penulis' => 'required',
            'jumlah' => 'required'
        ];
        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $books_id = [];
        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row, $rowRules);
            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;
            // Syntax dibawah dieksekusi jika baris excel ini valid
            // Cek apakah Penulis sudah terdaftar di database
            $author = Author::where('name', $row['penulis'])->first();
            // buat penulis jika belum ada
            if (!$author) {
                $author = Author::create(['name' => $row['penulis']]);
            }
            // buat buku baru
            $book = Book::create([
                'title' => $row['judul'],
                'author_id' => $author->id,
                'amount' => $row['jumlah']
            ]);
            // catat id dari buku yang baru dibuat
            array_push($books_id, $book->id);
        }

        // Ambil semua buku yang baru dibuat
        $books = Book::whereIn('id', $books_id)->get();
        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($books->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }
        // set feedback
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $books->count() . " buku."
        ]);
        // Tampilkan index buku
        // return redirect()->route('books.index');
        return view('books.import-review')->with(compact('books'));

        return $excels;
    }
}
