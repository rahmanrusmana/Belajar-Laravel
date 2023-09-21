<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id', 'is_returned'];

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    protected $casts = [
        'is_returned' => 'boolean',
    ];
    public function scopeReturned($query)
    {
        return $query->where('is_returned', 1);
    }
    public function scopeBorrowed($query)
    {
        return $query->where('is_returned', 0);
    }
}
