<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', 'tr'); // Default to Turkish
        $supportedLocales = ['tr', 'en', 'de', 'ru'];
        
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'tr';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
