<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $exclusive = $request->query('exclusive');

        $query = Product::query()
            ->with('category')
            ->where('active', true);

        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        if ($exclusive !== null && $exclusive !== '') {
            $query->where('exclusive', (bool) $exclusive);
        }

        $products = $query
            ->orderByDesc('id')
            ->paginate(12)
            ->appends($request->query());

        $viewData = [];
        $viewData['title'] = __('product.index_title');
        $viewData['products'] = $products;
        $viewData['showPagination'] = true;
        $viewData['search'] = $search;
        $viewData['selectedExclusive'] = $exclusive;

        return view('products.index', ['viewData' => $viewData]);
    }

    public function show(Product $product): View
    {
        $product->load('category', 'reviews.user');

        $viewData = [];
        $viewData['title'] = $product->getName();
        $viewData['product'] = $product;

        return view('products.show', ['viewData' => $viewData]);
    }
}
