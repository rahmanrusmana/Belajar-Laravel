<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Book;

class BookExport implements FromCollection, WithHeadings
{
    protected $books;

    public function __construct($books)
    {
        $this->books = $books;
    }

    public function collection()
    {
        return $this->books;
    }

    public function headings(): array
    {
        return [
            '1',
            '2',
            '3',
            '4',
           
        ];
    }

    // public function style(worksheet $sheet)
    // {
    //     return [
    //         1 => ['font' => {'bold' => true}]
    //     ];
    // }

    public function map($book): array
    {
        return [
            $book->title,
            $book->author_id,
            $book->amount,
            $book->cover,
            $book->create_at,
            $book->update_at,
            $book->author->name,
        ];
    }
}