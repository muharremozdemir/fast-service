<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Eğer session'da para birimi yoksa varsayılanı ayarla
        if (!Session::has('currency')) {
            $defaultCurrency = Currency::getDefault();
            Session::put('currency', $defaultCurrency ? $defaultCurrency->code : 'TRY');
        }

        // Request'ten gelen currency parametresini kontrol et
        if ($request->has('currency')) {
            $currency = Currency::where('code', $request->currency)
                ->where('is_active', true)
                ->first();
            
            if ($currency) {
                Session::put('currency', $currency->code);
            }
        }

        return $next($request);
    }
}
