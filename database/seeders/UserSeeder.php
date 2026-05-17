<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'        => 'Administrador',
            'email'       => 'admin@growandbloom.com',
            'password'    => Hash::make('password'),
            'role'        => User::ROLE_ADMIN,
            'phone'       => '3001234567',
            'address'     => 'Calle 1 # 1-1',
            'city'        => 'Medellín',
            'postal_code' => '050001',
        ]);

        $users = [
            ['name' => 'Carlos Pérez',      'email' => 'carlos@example.com',    'city' => 'Medellín'],
            ['name' => 'Ana García',         'email' => 'ana@example.com',       'city' => 'Bogotá'],
            ['name' => 'Luis Martínez',      'email' => 'luis@example.com',      'city' => 'Cali'],
            ['name' => 'María López',        'email' => 'maria@example.com',     'city' => 'Barranquilla'],
            ['name' => 'Jorge Ramírez',      'email' => 'jorge@example.com',     'city' => 'Medellín'],
            ['name' => 'Sofía Torres',       'email' => 'sofia@example.com',     'city' => 'Pereira'],
            ['name' => 'Andrés Díaz',        'email' => 'andres@example.com',    'city' => 'Manizales'],
            ['name' => 'Valentina Herrera',  'email' => 'valentina@example.com', 'city' => 'Medellín'],
            ['name' => 'Camila Moreno',      'email' => 'camila@example.com',    'city' => 'Bucaramanga'],
            ['name' => 'Felipe Castro',      'email' => 'felipe@example.com',    'city' => 'Bogotá'],
        ];

        foreach ($users as $index => $userData) {
            User::create([
                'name'        => $userData['name'],
                'email'       => $userData['email'],
                'password'    => Hash::make('password'),
                'role'        => User::ROLE_USER,
                'phone'       => '300' . str_pad((string) ($index + 1000000), 7, '0', STR_PAD_LEFT),
                'address'     => 'Calle ' . (($index + 1) * 10) . ' # ' . ($index + 1) . '-' . (($index + 1) * 5),
                'city'        => $userData['city'],
                'postal_code' => (string) (50000 + $index * 100),
            ]);
        }
    }
}
