<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GrupaZaNastavu;

class GrupaZaNastavuSeeder extends Seeder
{
    public function run(): void
    {
        GrupaZaNastavu::create([
            'naziv_grupe' => 'admin',
        ]);

        GrupaZaNastavu::create([
            'naziv_grupe' => 'IT',
        ]);

        GrupaZaNastavu::create([
            'naziv_grupe' => 'MGMT',
        ]);
    }
}
