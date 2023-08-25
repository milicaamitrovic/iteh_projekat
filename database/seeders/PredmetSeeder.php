<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Predmet;

class PredmetSeeder extends Seeder
{
    public function run(): void
    {
        Predmet::create(['naziv_predmeta'=>'Operaciona istrazivanja 1']);
        Predmet::create(['naziv_predmeta'=>'Upravljanje projektima']);
        Predmet::create(['naziv_predmeta'=>'Elektronsko poslovanje']);
        Predmet::create(['naziv_predmeta'=>'Osnove kvaliteta']);
        Predmet::create(['naziv_predmeta'=>'Internet tehnologije']);
        Predmet::create(['naziv_predmeta'=>'Marketing']);
        Predmet::create(['naziv_predmeta'=>'Matematika 1']);
        Predmet::create(['naziv_predmeta'=>'Baze podataka']);
        Predmet::create(['naziv_predmeta'=>'Poslovno pravo']);
    }
}
