<?php

// Author: Emily Cardona Castañeda

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $plantas = Category::where('name', 'Plantas')->first();
        $semillas = Category::where('name', 'Semillas')->first();
        $abonos = Category::where('name', 'Abonos y Fertilizantes')->first();
        $herramientas = Category::where('name', 'Herramientas')->first();
        $macetas = Category::where('name', 'Macetas y Decoración')->first();

        $plants = [
            // Plantas
            [
                'name' => 'Orquídea Phalaenopsis Blanca',
                'size' => 'Mediana',
                'color' => 'Blanco',
                'price' => 45000,
                'stock' => 25,
                'active' => true,
                'description' => 'Elegante orquídea Phalaenopsis de floración prolongada, ideal para interiores luminosos.',
                'image' => null,
                'category_id' => $plantas->getId(),
            ],
            [
                'name' => 'Helecho Boston',
                'size' => 'Grande',
                'color' => 'Verde',
                'price' => 28000,
                'stock' => 30,
                'active' => true,
                'description' => 'Frondoso helecho Nephrolepis, perfecto para espacios con humedad.',
                'image' => null,
                'category_id' => $plantas->getId(),
            ],
            [
                'name' => 'Suculenta Echeveria Mix',
                'size' => 'Pequeña',
                'color' => 'Multicolor',
                'price' => 12000,
                'stock' => 80,
                'active' => true,
                'description' => 'Suculenta Echeveria surtida, requiere mínimo riego.',
                'image' => null,
                'category_id' => $plantas->getId(),
            ],
            [
                'name' => 'Monstera Deliciosa',
                'size' => 'Grande',
                'color' => 'Verde oscuro',
                'price' => 75000,
                'stock' => 15,
                'active' => true,
                'description' => 'La icónica planta tropical con hojas perforadas. Perfecta para interiores amplios.',
                'image' => null,
                'category_id' => $plantas->getId(),
            ],
            [
                'name' => 'Pothos Dorado',
                'size' => 'Mediana',
                'color' => 'Verde y amarillo',
                'price' => 18000,
                'stock' => 50,
                'active' => true,
                'description' => 'Epipremnum aureum, planta colgante de fácil cuidado, ideal para principiantes.',
                'image' => null,
                'category_id' => $plantas->getId(),
            ],
            // Semillas
            [
                'name' => 'Semillas de Tomate Cherry',
                'size' => 'Sobre 2g',
                'color' => 'N/A',
                'price' => 8500,
                'stock' => 100,
                'active' => true,
                'description' => 'Semillas certificadas de tomate cherry, alta tasa de germinación (85%).',
                'image' => null,
                'category_id' => $semillas->getId(),
            ],
            [
                'name' => 'Semillas de Albahaca Genovesa',
                'size' => 'Sobre 1g',
                'color' => 'N/A',
                'price' => 6000,
                'stock' => 120,
                'active' => true,
                'description' => 'Albahaca aromática variedad genovesa, ideal para cocina y huerta urbana.',
                'image' => null,
                'category_id' => $semillas->getId(),
            ],
            [
                'name' => 'Mezcla Flores Silvestres',
                'size' => 'Sobre 5g',
                'color' => 'Multicolor',
                'price' => 14000,
                'stock' => 60,
                'active' => true,
                'description' => 'Mix de semillas de flores silvestres nativas, atrae polinizadores.',
                'image' => null,
                'category_id' => $semillas->getId(),
            ],
            // Abonos
            [
                'name' => 'Compost Orgánico Premium 5kg',
                'size' => '5 kg',
                'color' => 'N/A',
                'price' => 35000,
                'stock' => 40,
                'active' => true,
                'description' => 'Compost 100% orgánico madurado, mejora la estructura y fertilidad del suelo.',
                'image' => null,
                'category_id' => $abonos->getId(),
            ],
            [
                'name' => 'Fertilizante Líquido Plantas de Interior',
                'size' => '500 ml',
                'color' => 'N/A',
                'price' => 22000,
                'stock' => 55,
                'active' => true,
                'description' => 'Fertilizante concentrado NPK equilibrado para plantas de interior.',
                'image' => null,
                'category_id' => $abonos->getId(),
            ],
            // Herramientas
            [
                'name' => 'Tijeras de Poda Profesional',
                'size' => 'Talla única',
                'color' => 'Verde / Plateado',
                'price' => 55000,
                'stock' => 20,
                'active' => true,
                'description' => 'Tijeras de poda con hoja de acero inoxidable y mango ergonómico antideslizante.',
                'image' => null,
                'category_id' => $herramientas->getId(),
            ],
            [
                'name' => 'Regadera de Cobre 2L',
                'size' => '2 litros',
                'color' => 'Cobre',
                'price' => 68000,
                'stock' => 12,
                'active' => true,
                'description' => 'Regadera artesanal en cobre con cuello largo, perfecta para plantas de interior.',
                'image' => null,
                'category_id' => $herramientas->getId(),
            ],
            // Macetas
            [
                'name' => 'Maceta de Barro Artesanal',
                'size' => 'Ø 20 cm',
                'color' => 'Terracota',
                'price' => 25000,
                'stock' => 35,
                'active' => true,
                'description' => 'Maceta de barro poroso fabricada artesanalmente, favorece la respiración de las raíces.',
                'image' => null,
                'category_id' => $macetas->getId(),
            ],
        ];

        foreach ($plants as $plant) {
            Plant::create($plant);
        }
    }
}
