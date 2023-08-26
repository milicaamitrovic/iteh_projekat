<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GrupaZaNastavu;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // $grupa1 = GrupaZaNastavu::find(1);
        // $grupa2 = GrupaZaNastavu::find(2);

        // User::create([
        //     'ime' => 'Milica',
        //     'prezime' => 'Mitrovic',
        //     'brojIndeksa' => '55/2019',
        //     'email' => 'mm5519@fon.bg.ac.rs',
        //     'password' => bcrypt('mm5519'),
        //     'administrator' => false,
        //     'grupa_za_nastavu_id' => $grupa1->id,
        // ]);

        // User::create([
        //     'ime' => 'Ana',
        //     'prezime' => 'Vujicic',
        //     'brojIndeksa' => '66/2019',
        //     'email' => 'av6619@fon.bg.ac.rs',
        //     'password' => bcrypt('av6619'),
        //     'administrator' => false,
        //     'grupa_za_nastavu_id' => $grupa1->id,
        // ]);

        $grupa= GrupaZaNastavu::create([
            'naziv_grupe' => 'admin',
        ]);
         User::create([
             'ime' => 'Anja',
             'prezime' => 'Cirkovic',
             'broj_indeksa' => '77/2019',
             'email' => 'ac7719@fon.bg.ac.rs',
             'password' => bcrypt('ac7719'),
             'administrator' => false,
             'grupa_za_nastavu_id' => $grupa->id,
         ]);

        User::factory()->count(5)->create();
    }
}
