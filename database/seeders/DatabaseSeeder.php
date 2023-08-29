<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GrupaZaNastavuSeeder;
use Database\Seeders\PredmetSeeder;
use Database\Seeders\DanSeeder;
use Database\Seeders\VremenskiIntervalSeeder;
use Database\Seeders\RasporedNastaveSeeder;
use Database\Seeders\StavkaRasporedaSeeder;
use Database\Seeders\EvidencijaPrisustvaSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $grupa = new GrupaZaNastavuSeeder();
        $user = new UserSeeder();
        $predmet = new PredmetSeeder();
        $dan = new DanSeeder();
        $interval = new VremenskiIntervalSeeder();

        $grupa->run();
        $user->run();
        $predmet->run();
        $dan->run();
        $interval->run();
        $raspored = new RasporedNastaveSeeder();
        $raspored->run();
        $stavka_rasporeda = new StavkaRasporedaSeeder();
        $stavka_rasporeda->run();
        $evidencija = new EvidencijaPrisustvaSeeder();
        $evidencija->run();

    }
}
