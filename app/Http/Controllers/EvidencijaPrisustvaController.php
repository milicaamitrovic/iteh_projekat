<?php

namespace App\Http\Controllers;

use App\Models\EvidencijaPrisustva;
use App\Http\Resources\EvidencijaPrisustvaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvidencijaPrisustvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidencije = EvidencijaPrisustva::all();
        return EvidencijaPrisustvaResource::collection($evidencije);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $evidencija_postoji = EvidencijaPrisustva::where('datum', $request->datum)->where('korisnik_id', Auth::user()->id)->first();

        if ($evidencija_postoji) {
            return response()->json('Vec ste se evidentirali!');
        }

        $evidencija_prisustva = EvidencijaPrisustva::create([
            'datum' => $request->datum,
            'korisnik_id' => Auth::user()->id
        ]);

        return response()->json('Evidentirali ste za nastavu dana: ' . $request->datum);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evidencija_prisustva = EvidencijaPrisustva::find($id);

        if ($evidencija_prisustva) {

           return new EvidencijaPrisustvaResource($evidencija_prisustva);

        } else {

           return response()->json('Evidencija prisustva sa trazenim id-jem ne postoji.');

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvidencijaPrisustva $evidencijaPrisustva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvidencijaPrisustva $evidencijaPrisustva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvidencijaPrisustva $evidencijaPrisustva)
    {
        //
    }
}
