<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //SAMPLE PENULIS
        $author1 = Author::create(['name'=>'Mohammad Fauzi Adhim']);
        $author2 = Author::create(['name'=>'Salim A. Fillah']);
        $author3 = Author::create(['name'=>'Aam Amirudin']);

        //SAMPLE BUKU   
        $book = Book::create(['title'=>'Kupinang Engkau Dengan Hamdalah', 'amount'=>3, 'author_id'=>$author1->id]);
        $book = Book::create(['title'=>'Jalan Cinta Para Pejuang', 'amount'=>2, 'author_id'=>$author2->id]);
        $book = Book::create(['title'=>'Membingkai Surga Dalam Rumah Tangga', 'amount'=>3, 'author_id'=>$author3->id]);
        $book = Book::create(['title'=>'Cinta & Seks Rumah Tangga Muslim', 'amount'=>4, 'author_id'=>$author3->id]);
    }
}
