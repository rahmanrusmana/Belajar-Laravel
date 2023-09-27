<?php

namespace App\Models\Book;

use Yajra\DataTables\Facades\DataTables;

class BookTableFormatter
{
    public static function format($books)
    {
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
}
