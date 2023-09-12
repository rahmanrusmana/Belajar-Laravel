<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->check()) {
            // Pengguna sudah terautentikasi, lanjutkan ke permintaan berikutnya
            return $next($request);
        }

        // Pengguna belum terautentikasi, arahkan mereka ke halaman login
        return redirect('/login');
    }
}
