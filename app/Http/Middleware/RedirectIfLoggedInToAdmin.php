<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedInToAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // DAN apakah rute yang sedang diakses adalah rute 'login' ATAU 'register'
            if ($request->routeIs('login') || $request->routeIs('register')) {
                // Jika ya, arahkan pengguna langsung ke rute admin.dashboard
                return redirect()->route('admin.dashboard');
            }
        }

        // Jika tidak, biarkan request berlanjut ke middleware atau kontroler berikutnya
        return $next($request);
    }
}
