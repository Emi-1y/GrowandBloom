<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'color' => $this->getColor(),
            'size' => $this->getSize(),
            'stock' => $this->getStock(),
            'description' => $this->getDescription(),
            'image' => $this->getImage(),
            'category' => $this->getCategory()->getName(),
            'url' => route('plant.show', $this->getId()),
        ];
    }
}
