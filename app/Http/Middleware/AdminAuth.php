<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Önce session auth kontrolü yap
        if (Auth::check()) {
            // Session geçerli, devam et
            // JWT token cookie'de veya session'da olabilir, ama session yeterli
            return $next($request);
        }
        
        // Session yok, login sayfasına yönlendir
        return redirect()->route('auth.login');
    }
}

