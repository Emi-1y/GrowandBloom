<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Grow and Bloom';
        $viewData['featuredProducts'] = Product::with('category')
            ->where('active', true)
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('home.index', ['viewData' => $viewData]);
    }
}
