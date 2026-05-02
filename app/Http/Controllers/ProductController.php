<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');
        $exclusive = $request->query('exclusive');

        $query = Product::query()
            ->with('category')
            ->where('active', true);

        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        if (! empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if ($exclusive !== null && $exclusive !== '') {
            $query->where('exclusive', (bool) $exclusive);
        }

        $products = $query
            ->orderByDesc('id')
            ->paginate(12)
            ->appends($request->query());

        $viewData = [
            'title' => __('product.index_title'),
            'products' => $products,
            'showPagination' => true,
            'categories' => Category::orderBy('name')->get(),
            'search' => $search,
            'selectedCategory' => $categoryId,
            'selectedExclusive' => $exclusive,
        ];

        return view('products.index', ['viewData' => $viewData]);
    }

    public function show(Product $product): View
    {
        $product->load('category', 'reviews.user');

        $viewData = [
            'title' => $product->getName(),
            'product' => $product,
        ];

        return view('products.show', ['viewData' => $viewData]);
    }
}
