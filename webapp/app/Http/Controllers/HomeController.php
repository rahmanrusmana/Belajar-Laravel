<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Author;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }


    public function index()
    {
        if (Laratrust::hasRole('admin')) return $this->adminDashboard();
        if (Laratrust::hasRole('member')) return $this->memberDashboard();
        return view('home');
    }
    protected function adminDashboard()
    {
        $authors = [];
        $books = [];
        foreach (Author::all() as $author) {
            array_push($authors, $author->name);
            array_push($books, $author->books->count());
        }
        return view('dashboard.admin', compact('authors', 'books'));
    }
    protected function memberDashboard()
    {
        $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();
        return view('dashboard.member', compact('borrowLogs'));
    }
}
