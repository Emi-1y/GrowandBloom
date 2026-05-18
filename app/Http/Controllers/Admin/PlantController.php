<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\StorePlantRequest;
use App\Http\Requests\Plant\UpdatePlantRequest;
use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlantController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('plant.admin_list_title');
        $viewData['subtitle'] = __('plant.admin_list_subtitle');
        $viewData['plants'] = Plant::with('category')->orderBy('id', 'desc')->get();

        return view('admin.plant.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('plant.create_title');
        $viewData['subtitle'] = __('plant.create_subtitle');
        $viewData['categories'] = Category::orderBy('name')->get();

        return view('admin.plant.create')->with('viewData', $viewData);
    }

    public function store(StorePlantRequest $request): RedirectResponse
    {
        Plant::create($request->validated());

        return redirect()->route('admin.plant.index')->with('success', __('plant.created_successfully'));
    }

    public function edit(Plant $plant): View
    {
        $viewData = [];
        $viewData['title'] = __('plant.edit_title');
        $viewData['subtitle'] = __('plant.edit_subtitle');
        $viewData['plant'] = $plant;
        $viewData['categories'] = Category::orderBy('name')->get();

        return view('admin.plant.edit')->with('viewData', $viewData);
    }

    public function update(UpdatePlantRequest $request, Plant $plant): RedirectResponse
    {
        $plant->update($request->validated());

        return redirect()->route('admin.plant.index')->with('success', __('plant.updated_successfully'));
    }

    public function destroy(Plant $plant): RedirectResponse
    {
        $plant->delete();

        return redirect()->route('admin.plant.index')->with('success', __('plant.deleted_successfully'));
    }
}
