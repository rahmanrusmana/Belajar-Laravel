<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function getAllAuthors()
    {
        return static::all();
    }
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($author) {
            if ($author->books->count() > 0) {
                $html = 'Penulis tidak bisa dihapus karena masih memiliki buku : ';
                $html .= '<ul>';
                foreach ($author->books as $book) {
                    $html .= "<li>$book->title</li>";
                }
                $html .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html
                ]);
                return false;
            }
        });
    }

    public function getUpdateSuccessMessageAttribute()
    {
        return "Berhasil menyimpan $this->name";
    }
}
