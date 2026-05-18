<?php

// Author: Emily Cardona Castañeda

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            PlantSeeder::class,
            ServiceSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
