<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlantController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $query = Plant::query()
            ->with('category')
            ->where('active', true);

        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $plants = $query
            ->orderByDesc('id')
            ->paginate(12)
            ->appends($request->query());

        $viewData = [];
        $viewData['title'] = __('plant.index_title');
        $viewData['plants'] = $plants;
        $viewData['showPagination'] = true;
        $viewData['search'] = $search;

        return view('plants.index')->with('viewData', $viewData);
    }

    public function show(Plant $plant): View
    {
        $plant->load('category');

        $viewData = [];
        $viewData['title'] = $plant->getName();
        $viewData['plant'] = $plant;

        return view('plants.show')->with('viewData', $viewData);
    }
}
