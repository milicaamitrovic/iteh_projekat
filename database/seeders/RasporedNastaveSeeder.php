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
        $grupa_it = GrupaZaNastavu::where('naziv_grupe', 'ISIT')->first();
        $grupa_mgmt = GrupaZaNastavu::where('naziv_grupe', 'MGMT')->first();
        $korisnik = User::where('ime', 'admin')->where('administrator', true)->first();

        if ($grupa_it && $korisnik) {
            RasporedNastave::create([
                //'id' => 1,
                'naziv_rasporeda' => 'Raspored za ISIT grupu',
                'datum_od' => Carbon::parse('2022-10-01')->startOfDay(),
                'datum_do' => Carbon::parse('2023-01-01')->startOfDay(),
                'grupa_za_nastavu_id' => $grupa_it->id,
                'korisnik_id' => $korisnik->id,
            ]);
        }
        if ($grupa_mgmt && $korisnik) {
            RasporedNastave::create([
                //'id' => 2,
                'naziv_rasporeda' => 'Raspored za MGMT grupu',
                'datum_od' => Carbon::parse('2022-10-01')->startOfDay(),
                'datum_do' => Carbon::parse('2023-01-01')->startOfDay(),
                'grupa_za_nastavu_id' => $grupa_mgmt->id,
                'korisnik_id' => $korisnik->id,
            ]);
        }
    }
}
