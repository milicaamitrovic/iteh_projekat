<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StavkaRasporeda;
use App\Models\RasporedNastave;
use App\Models\Dan;
use App\Models\VremenskiInterval;
use App\Models\Predmet;

class StavkaRasporedaSeeder extends Seeder
{
    public function run(): void
    {
        $raspored_it = RasporedNastave::where('naziv_rasporeda', 'Raspored za ISIT grupu')->first();
        $raspored_mgmt = RasporedNastave::where('naziv_rasporeda', 'Raspored za MGMT grupu')->first();
        
        $ponedeljak = Dan::where('naziv_dana', 'ponedeljak')->first();
        $utorak = Dan::where('naziv_dana', 'utorak')->first();
        $sreda = Dan::where('naziv_dana', 'sreda')->first();
        $cetvrtak = Dan::where('naziv_dana', 'cetvrtak')->first();
        $petak = Dan::where('naziv_dana', 'petak')->first();

        $prvi_cas = VremenskiInterval::where('interval', '08:15-10:00')->first();
        $drugi_cas = VremenskiInterval::where('interval', '10:15-12:00')->first();
        $treci_cas = VremenskiInterval::where('interval', '12:15-14:00')->first();
        $cetvrti_cas = VremenskiInterval::where('interval', '14:15-16:00')->first();
        $peti_cas = VremenskiInterval::where('interval', '16:15-18:00')->first();

        $oi1 = Predmet::where('naziv_predmeta', 'Operaciona istrazivanja 1')->first();
        $bp = Predmet::where('naziv_predmeta', 'Baze podataka')->first();
        $epos = Predmet::where('naziv_predmeta', 'Elektronsko poslovanje')->first();
        $up = Predmet::where('naziv_predmeta', 'Upravljanje projektima')->first();
        $ok = Predmet::where('naziv_predmeta', 'Osnove kvaliteta')->first();
        $it = Predmet::where('naziv_predmeta', 'Internet tehnologije')->first();
        $pp = Predmet::where('naziv_predmeta', 'Poslovno pravo')->first();
        $m1 = Predmet::where('naziv_predmeta', 'Matematika 1')->first();
        $ma = Predmet::where('naziv_predmeta', 'Marketing')->first();

        
        if ($raspored_it) {
            StavkaRasporeda::create([
                //'id' => 1,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $ponedeljak->id,
                'vremenski_interval_id'=> $drugi_cas->id,
                'predmet_id' => $oi1->id,
            ]);
            StavkaRasporeda::create([
                //'id' => 2,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $ponedeljak->id,
                'vremenski_interval_id'=> $treci_cas->id,
                'predmet_id' => $bp->id,
            ]);
            
            StavkaRasporeda::create([
                //'id' => 3,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $utorak->id,
                'vremenski_interval_id'=> $treci_cas->id,
                'predmet_id' => $epos->id,
            ]);

            StavkaRasporeda::create([
                //'id' => 4,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $sreda->id,
                'vremenski_interval_id'=> $treci_cas->id,
                'predmet_id' => $up->id,
            ]);

            StavkaRasporeda::create([
                //'id' => 5,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $cetvrtak->id,
                'vremenski_interval_id'=> $prvi_cas->id,
                'predmet_id' => $ok->id,
            ]);

             StavkaRasporeda::create([
                //'id' => 6,
                'raspored_id' => $raspored_it->id,
                'dan_id' => $petak->id,
                'vremenski_interval_id'=> $prvi_cas->id,
                'predmet_id' => $it->id,
            ]);
        }

        if ($raspored_mgmt) {
            StavkaRasporeda::create([
                //'id' => 1,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $ponedeljak->id,
                'vremenski_interval_id'=> $treci_cas->id,
                'predmet_id' => $m1->id,
            ]);
            StavkaRasporeda::create([
                //'id' => 2,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $utorak->id,
                'vremenski_interval_id'=> $peti_cas->id,
                'predmet_id' => $ma->id,
            ]);
            
            StavkaRasporeda::create([
                //'id' => 3,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $sreda->id,
                'vremenski_interval_id'=> $cetvrti_cas->id,
                'predmet_id' => $up->id,
            ]);

            StavkaRasporeda::create([
                //'id' => 4,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $sreda->id,
                'vremenski_interval_id'=> $peti_cas->id,
                'predmet_id' => $epos->id,
            ]);

            StavkaRasporeda::create([
                //'id' => 5,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $cetvrtak->id,
                'vremenski_interval_id'=> $treci_cas->id,
                'predmet_id' => $ok->id,
            ]);

             StavkaRasporeda::create([
                //'id' => 6,
                'raspored_id' => $raspored_mgmt->id,
                'dan_id' => $petak->id,
                'vremenski_interval_id'=> $cetvrti_cas->id,
                'predmet_id' => $pp->id,
            ]);
        }

    
    }

}