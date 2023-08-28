<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StavkaRasporeda;
use App\Models\RasporedNastave;
use App\Http\Resources\StavkaRasporedaCollection;
use App\Http\Resources\StavkaRasporedaResource;
use App\Http\Resources\RasporedNastaveResource;

class StavkaRasporedaController extends Controller
{
    public function index()
    {
        $stavke = StavkaRasporeda::all();
        return new StavkaRasporedaCollection($stavke);
    }

    public function show($id)
    {
        $stavka =StavkaRasporeda::find($id);

         if ($stavka) {

            return new StavkaRasporedaResource($stavka);

         } else {

            return response()->json('Stavka sa trazenim id ne postoji.');

            }
    }
}
