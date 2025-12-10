<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cookie'den JWT token'ı al
        $token = $request->cookie('jwt_token');
        
        // Eğer cookie'de token varsa, Authorization header'a ekle
        if ($token && !$request->hasHeader('Authorization')) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        
        return $next($request);
    }
}

