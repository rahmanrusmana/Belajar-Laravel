<?php

// app/Services/BookService.php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class BookService
{
    // UNTUK COVER BUKU
    public function storeBook(array $bookData, ?UploadedFile $cover = null): Book
    {
        if ($cover) {
            $filename = $this->uploadCover($cover);
            $bookData['cover'] = $filename;
        }

        $book = Book::create($bookData);

        $message = "Berhasil menyimpan $book->title";

        if (!$cover) {
            $message .= " tanpa cover";
        }

        session()->flash("flash_notification", [
            'level' => 'success',
            'message' => $message
        ]);

        return $book;
    }

    private function uploadCover(UploadedFile $cover): string
    {
        $extension = $cover->getClientOriginalExtension();
        $filename = md5(time()) . '.' . $extension;

        $destinationPath = public_path('img');
        $cover->move($destinationPath, $filename);

        return $filename;
    }

    // UNTUK UPDATE BUKU
    public function updateBook(Book $book, array $bookData, ?UploadedFile $cover = null): bool
    {
        if (!$book->update($bookData)) {
            return false;
        }

        if ($cover) {
            $filename = $this->uploadCover($cover);

            if ($book->cover) {
                $this->deleteOldCover($book->cover);
            }

            $book->cover = $filename;
            $book->save();
        }

        return true;
    }

    private function deleteOldCover(string $cover): void
    {
        $filepath = public_path('img') . DIRECTORY_SEPARATOR . $cover;

        if (File::exists($filepath)) {
            File::delete($filepath);
        }
    }
}


