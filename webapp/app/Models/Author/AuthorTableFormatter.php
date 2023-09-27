<?php

namespace App\Models\Author;

use Yajra\DataTables\Facades\DataTables;

class AuthorTableFormatter
{
    public static function format($authors)
    {
        return DataTables::of($authors)
            ->addColumn('action', function ($author) {
                return view('datatable._action', [
                    'model' => $author,
                    'form_url' => route('authors.destroy', $author->id),
                    'edit_url' => route('authors.edit', $author->id),
                    'confirm_message' => 'Apakah anda yakin ingin menghapus ' . $author->name . '?'
                ]);
            })->make(true);
    }
}
