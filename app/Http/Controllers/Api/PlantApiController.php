<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlantCollection;
use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\JsonResponse;

class PlantApiController extends Controller
{
    public function index(): JsonResponse
    {
        $plants = new PlantCollection(
            Plant::with('category')->where('active', true)->get()
        );

        return response()->json($plants, 200);
    }

    public function show(string $id): JsonResponse
    {
        $plant = new PlantResource(
            Plant::with('category')->findOrFail($id)
        );

        return response()->json($plant, 200);
    }
}
