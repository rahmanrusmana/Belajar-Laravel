<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Author\AuthorTableFormatter;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorsController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $authors = Author::getAllAuthors();
            return AuthorTableFormatter::format($authors);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, '\searchable' => false]);

        return view('authors.index')->with(compact('html'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->all());

        Session::flash("flash_notification", [
            "level" => 'success',
            'message' => 'Berhasil menyimpan data ' . $author->name
        ]);
        return redirect()->route('authors.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        //
        $author = Author::find($id);
        return view('authors.edit')->with(compact('author'));
    }

    // UPDATE NAMA PENULIS
    public function update(AuthorUpdateRequest $request, $id)
    {
        $author = Author::find($id);
        $author->update($request->only('name'));

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => $author->update_success_message,
        ]);

        return redirect()->route('authors.index');
    }

    public function destroy(string $id)
    {
        if (!Author::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Penulis berhasil dihapus"
        ]);

        return redirect()->route('authors.index');
    }
}
