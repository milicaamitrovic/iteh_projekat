<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StavkaRasporeda;
use App\Http\Resources\StavkaRasporedaResource;

class RasporedStavkeRasporedaController extends Controller
{
    public function index($raspored_id)
    {
        $stavke = StavkaRasporeda::get()->where('raspored_id', $raspored_id);

        if($stavke->isEmpty())
        {
            return response()->json('Ne postoji nijedna stavka za raspored trazenog id-a!');
        } else {
            return StavkaRasporedaResource::collection($stavke);
        }

    }
}
