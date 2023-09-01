<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EvidencijaPrisustva;
use App\Models\User;
use Carbon\Carbon;

class EvidencijaPrisustvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $korisnik_1 = User::where('id', '2')->first();
        $korisnik_2 = User::where('id', '3')->first();
        $korisnik_3 = User::where('id', '4')->first();
        $korisnik_4 = User::where('id', '5')->first();

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-22'),
            'korisnik_id' => $korisnik_2->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-23'),
            'korisnik_id' => $korisnik_2->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-23'),
            'korisnik_id' => $korisnik_3->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-24'),
            'korisnik_id' => $korisnik_4->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-25'),
            'korisnik_id' => $korisnik_1->id
        ]);


        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-25'),
            'korisnik_id' => $korisnik_3->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-28'),
            'korisnik_id' => $korisnik_1->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-28'),
            'korisnik_id' => $korisnik_2->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-28'),
            'korisnik_id' => $korisnik_4->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-29'),
            'korisnik_id' => $korisnik_1->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-29'),
            'korisnik_id' => $korisnik_2->id
        ]);

        EvidencijaPrisustva::create([
            'datum' => Carbon::parse('2023-08-30'),
            'korisnik_id' => $korisnik_3->id
        ]);
    }
}
