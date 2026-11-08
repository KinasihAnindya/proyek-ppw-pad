<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && strtolower(Auth::user()->level) === 'admin') {
            return $next($request); // Izinkan masuk ke halaman /users
        }
        if (Auth::check()) {
            return redirect('/berita')->with('error', 'Akses ditolak! Anda bukan Admin.');
        }
        return redirect('/login');
    }
}