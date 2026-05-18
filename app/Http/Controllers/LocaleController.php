<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    private const SUPPORTED = ['en', 'es'];

    public function switch(Request $request): RedirectResponse
    {
        $locale = $request->input('locale');

        if (in_array($locale, self::SUPPORTED, true)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
