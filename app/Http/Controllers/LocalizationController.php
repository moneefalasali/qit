<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        $supportedLocales = ['ar', 'en', 'hi', 'ur', 'bn', 'fa-AF', 'ps'];
        $locale = in_array($locale, $supportedLocales, true) ? $locale : 'ar';

        session(['locale' => $locale]);
        app()->setLocale($locale);

        return redirect()->back();
    }

    public function getLocale()
    {
        return session('locale', 'ar');
    }
}
