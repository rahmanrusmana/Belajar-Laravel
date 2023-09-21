<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\MyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [GuestController::class,'index']);

Route::get('/books/{book}/borrow', [BooksController::class, 'borrow']) -> name('guest.books.borrow');

Route::put('/books/{book}/return', [BooksController::class, 'returnBack'])->name('member.books.return');

Route::get('/auth/verify/{token}', [RegisterController::class, 'verify']);

Route::get('/auth/send-verification', [RegisterController::class, 'sendVerification']);

Route::get('settings/profile', [SettingsController::class, 'profile']);
Route::get('settings/profile/edit', [SettingsController::class, 'editprofile']);
Route::post('settings/profile', [SettingsController::class, 'updateprofile']);
Route::get('settings/password', [SettingsController::class, 'editPassword']);
Route::post('settings/password', [SettingsController::class, 'updatePassword']);
  
Route::get('/about', [MyController::class, 'showAbout']);  
Route::get('/test', [MyController::class, 'Home']);  


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {
    Route::resource('authors', AuthorsController::class);
    Route::resource('books', BooksController::class);
    Route::resource('members', MembersController::class);
    Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');

    Route::get('export/books', [BooksController::class, 'export'])->name('export.books');
    Route::post('export/books', [BooksController::class, 'exportPost'])->name('export.books.post');

    Route::get('template/books', [BooksController::class, 'generateExcelTemplate'])->name('template.books');
    Route::post('import/books', [BooksController::class, 'importExcel'])->name('import.books');
});

Route::get('/data', [DataController::class]);

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

