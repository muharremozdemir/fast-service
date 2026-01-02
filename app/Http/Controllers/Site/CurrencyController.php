<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    /**
     * Para birimini değiştir
     */
    public function switch($currencyCode)
    {
        $currency = Currency::where('code', $currencyCode)
            ->where('is_active', true)
            ->first();

        if (!$currency) {
            return redirect()->back()->with('error', 'Geçersiz para birimi.');
        }

        Session::put('currency', $currency->code);

        return redirect()->back()->with('success', 'Para birimi değiştirildi.');
    }

    /**
     * Aktif para birimlerini JSON olarak döndür
     */
    public function getActive()
    {
        $currencies = Currency::getActive();
        
        return response()->json([
            'currencies' => $currencies->map(function ($currency) {
                return [
                    'code' => $currency->code,
                    'symbol' => $currency->symbol,
                    'name' => $currency->name,
                ];
            }),
            'current' => Session::get('currency', 'TRY'),
        ]);
    }
}
