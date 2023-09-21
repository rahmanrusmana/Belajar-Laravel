<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function showAbout()
    {
        return view('about');
    }

    public function Home()
    {
        return view('home');
    }
}
