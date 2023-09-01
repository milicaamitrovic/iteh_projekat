<?php

namespace App\Http\Controllers;

use App\Models\EvidencijaPrisustva;
use App\Models\User;
use App\Http\Resources\EvidencijaPrisustvaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $korisnik = User::where('email', $request->email)->first();

        $evidencija_postoji = EvidencijaPrisustva::where('datum', $request->datum)->where('korisnik_id', $korisnik->id)->first();

        if ($evidencija_postoji) {
            return response()->json('Vec ste se evidentirali!');
        }

        $drzavni_praznici = Http::get('https://date.nager.at/api/v3/PublicHolidays/2023/RS');
        $data = $drzavni_praznici->json();
        
        $datumi_praznika = [];
        foreach ($data as $praznik) {
            $datumi_praznika[] = $praznik['date'];
        }

        if (in_array($request->datum, $datumi_praznika)) {
            return response()->json('Nažalost, danas je državni praznik i nije moguće evidentirati prisustvo.');
        }

        $vikend = ['Saturday', 'Sunday'];
        if (in_array(date('l', strtotime($request->datum)), $vikend)) {
            return response()->json('Nažalost, ne možete se evidentirati vikendom.');
        }
        
        $evidencija_prisustva = EvidencijaPrisustva::create([
            'datum' => $request->datum,
            'korisnik_id' => $korisnik->id
        ]);

        $formatiran_datum = Carbon::parse($request->datum)->format('d.m.Y.');

        return response()->json('Evidentirali ste se za nastavu dana: ' . $formatiran_datum);
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

    public function prikaziStatistiku()
    {
        $prisustva_po_danima = EvidencijaPrisustva::selectRaw('DATE(datum) as datum, COUNT(*) as broj_prisustava')->groupByRaw('DATE(datum)')->get();

        $labels = $prisustva_po_danima->pluck('datum');
        $data = $prisustva_po_danima->pluck('broj_prisustava');

        return view('statistika', compact('labels', 'data')); 
    }
}
