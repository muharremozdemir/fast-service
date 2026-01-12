<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the application locale
     */
    public function change(Request $request, $locale)
    {
        $supportedLocales = ['tr', 'en', 'de', 'ru'];
        
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'tr'; // Default to Turkish
        }

        Session::put('locale', $locale);
        app()->setLocale($locale);

        return redirect()->back();
    }
}
