<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Session;

class CurrencyService
{
    /**
     * TRY fiyatını seçili para birimine dönüştür
     */
    public function convertPrice($amount, $fromCurrency = 'TRY', $toCurrency = null)
    {
        if ($amount == 0) {
            return 0;
        }

        $toCurrency = $toCurrency ?? Session::get('currency', 'TRY');

        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        $from = Currency::where('code', $fromCurrency)->first();
        $to = Currency::where('code', $toCurrency)->first();

        if (!$from || !$to) {
            return $amount;
        }

        // TRY'den başka bir para birimine dönüşüm
        if ($fromCurrency === 'TRY') {
            return $to->convertFromTry($amount);
        }

        // Başka bir para biriminden TRY'ye dönüşüm
        if ($toCurrency === 'TRY') {
            return $from->convertToTry($amount);
        }

        // İki farklı para birimi arasında dönüşüm (TRY üzerinden)
        $tryAmount = $from->convertToTry($amount);
        return $to->convertFromTry($tryAmount);
    }

    /**
     * Fiyatı formatla (para birimi sembolü ile)
     */
    public function formatPrice($amount, $currencyCode = null)
    {
        if ($amount == 0) {
            $currencyCode = $currencyCode ?? Session::get('currency', 'TRY');
            $currency = Currency::where('code', $currencyCode)->first();
            if ($currency) {
                return '0' . ($currency->decimal_places > 0 ? ',' . str_repeat('0', $currency->decimal_places) : '') . ' ' . $currency->symbol;
            }
            return '0,00 ₺';
        }

        $currencyCode = $currencyCode ?? Session::get('currency', 'TRY');
        $currency = Currency::where('code', $currencyCode)->first();

        if (!$currency) {
            return number_format($amount, 2, ',', '.') . ' ₺';
        }

        return $currency->formatPrice($amount);
    }

    /**
     * Mevcut para birimini getir
     */
    public function getCurrentCurrency()
    {
        $currencyCode = Session::get('currency', 'TRY');
        return Currency::where('code', $currencyCode)->first() 
            ?? Currency::where('code', 'TRY')->first();
    }

    /**
     * TRY fiyatını mevcut para birimine dönüştür ve formatla
     */
    public function displayPrice($tryAmount)
    {
        $convertedAmount = $this->convertPrice($tryAmount, 'TRY');
        return $this->formatPrice($convertedAmount);
    }
}

