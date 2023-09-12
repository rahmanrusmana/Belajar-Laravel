<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\MyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [MyController::class, 'showAbout']);   

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
    Route::resource('authors', AuthorsController::class);
});

Route::get('/testmodel', function() {
    $query =Post::all();;
    return $query;

    // $query = Post::find(1); # Menampilkan data berdasarkan id yang telah ditentukan

    // $query = Post::find(1);
    // $query->title = "Title 1 diedit"; # Mengubah record
    // $query->save();

    // $query = new Post;
    // $query->title = "Judul Baru";
    // $query->content = "Konten baru."; # Menambah record
    // $query->save();

    // $query = Post::find(4);
    // $query->delete(); # Menghapus record
});
    



// Route::get('/home', ['middleware'=>'guest', 'uses'=>'MyController@myMethod']);

