<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Kalau belum login, arahkan ke login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        // Kalau sudah login, lanjut
        return $next($request);
    }
}
