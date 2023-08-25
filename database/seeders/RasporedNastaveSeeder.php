<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RasporedNastave;
use App\Models\User;
use App\Models\GrupaZaNastavu;
use Carbon\Carbon;

class RasporedNastaveSeeder extends Seeder
{
    public function run(): void
    {
        $grupa_it = GrupaZaNastavu::where('naziv_grupe', 'IT')->first();
        $korisnik = User::where('ime', 'admin')->where('administrator', true)->first();

        if ($grupa_it && $korisnik) {
            RasporedNastave::create([
                'naziv_rasporeda' => 'Raspored za IT grupu',
                'datum_od' => Carbon::parse('2022-10-01')->startOfDay(),
                'datum_do' => Carbon::parse('2023-01-01')->startOfDay(),
                'grupa_za_nastavu_id' => $grupa_it->id,
                'korisnik_id' => $korisnik->id,
            ]);
        }
    }
}
