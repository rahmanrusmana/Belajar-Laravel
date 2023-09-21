<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laratrust\Contracts\LaratrustUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Book;
use App\Models\BorrowLog;
use App\Exceptions\BookException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean'
    ];
    
    public function borrow(Book $book)
    {
        // Cek Apakah Masih Ada Stok Buku
        if($book->stock < 1 ) {
            throw new BookException("Buku $book->title Sedang Tidak Tersedia");
        }
        // cek apakah buku ini sedang dipinjam oleh user
        if($this->borrowLogs()->where('book_id',$book->id)->where('is_returned', 0)->count() > 0 ) {
            throw new BookException("Buku $book->title sedang Anda pinjam.");
        }
        $borrowLog = BorrowLog::create(['user_id'=>$this->id, 'book_id'=>$book->id]);

        return $borrowLog;
    }

    public function borrowLogs()
    {
        return $this->hasMany('App\Models\BorrowLog');
    }

    public function generateVerificationToken()
    {
        $token = $this->verification_token;
        if (!$token) {
            $token = Str::random(40);
            $this->verification_token = $token;
            $this->save();
        }
        return $token;
    }

    public function sendVerification()
    {
        $token = $this->generateVerificationToken();
        $user = $this;
        // $token = Str::random(40);
        // $user->verification_token = $token;
        // $user->save();
        Mail::send('auth.emails.verification', compact('user', 'token'), function ($m) use ($user){
            $m->to($user->email, $user->name)->subject('Verifikasi Akun Larapus');
        });
    }
    public function verify()
    {
        $this->is_verified = 1;
        $this->verification_token = null;
        $this->save();
    }
}
