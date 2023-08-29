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
        $adminUser = User::create(['ime' => 'admin', 
        'prezime' => 'admin', 
        'broj_indeksa' => '0000/0000', 
        'email' => 'admin@example.com', 
        'password' => 'admin',
        'administrator' => true,
        'grupa_za_nastavu_id' => 1]); 
        $adminUser->save();

        $User1 = User::create(['ime' => 'Milica', 
        'prezime' => 'Mitrovic', 
        'broj_indeksa' => '55/2019', 
        'email' => 'ms5519@fon.bg.ac.rs', 
        'password' => 'milica5519',
        'administrator' => false,
        'grupa_za_nastavu_id' => 2]);
        $User1->save();

        $User2 = User::create(['ime' => 'Anja', 
        'prezime' => 'Cirkovic', 
        'broj_indeksa' => '77/2019', 
        'email' => 'ac7719@fon.bg.ac.rs', 
        'password' => 'anja7719',
        'administrator' => false,
        'grupa_za_nastavu_id' => 2]);
        $User2->save();

        $User3 = User::create(['ime' => 'Dusica', 
        'prezime' => 'Sujdovic', 
        'broj_indeksa' => '137/2019', 
        'email' => 'ds13719@fon.bg.ac.rs', 
        'password' => 'dusica13719',
        'administrator' => false,
        'grupa_za_nastavu_id' => 2]);
        $User3->save();

        $User4 = User::create(['ime' => 'Marija', 
        'prezime' => 'Neskovic', 
        'broj_indeksa' => '203/2019', 
        'email' => 'mn20319@fon.bg.ac.rs', 
        'password' => 'marija20319',
        'administrator' => false,
        'grupa_za_nastavu_id' => 3]);
        $User4->save();
    }
}
