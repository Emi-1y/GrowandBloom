<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlantCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'additionalData' => [
                'storeName' => 'Grow and Bloom',
                'storePlantsLink' => route('plant.index'),
            ],
        ];
    }
}
