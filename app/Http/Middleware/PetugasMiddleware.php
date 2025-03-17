<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PetugasMiddleware


{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'petugas') {
            return $next($request);
        }

        return redirect('/dashboard'); // Redirect jika bukan petugas
    }
}


