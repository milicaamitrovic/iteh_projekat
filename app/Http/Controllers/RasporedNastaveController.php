<?php

namespace App\Http\Controllers;

use App\Models\RasporedNastave;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RasporedNastaveResource;

class RasporedNastaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rasporedNastave= RasporedNastave::all();
        return $rasporedNastave;
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
        $validator = Validator::make($request->all(), [
        'naziv_rasporeda' => 'required|string|max:255',
        'datum_od' => 'required|date',
        'datum_do' => 'required|date|after:datum_od',
        'grupa_za_nastavu_id' => 'required|integer',
        'korisnik_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri validaciji!', $validator->errors()]);
        }

        $rasporedNastave = RasporedNastave::create([
        'naziv_rasporeda' => $request->naziv_rasporeda,
        'datum_od' => $request->datum_od,
        'datum_do' => $request->datum_do,
        'grupa_za_nastavu_id' => $request->grupa_za_nastavu_id,
        'korisnik_id' => $request->korsinik_id,
         ]);

         return response()->json(['Raspored nastave je dodat!', new RasporedNastaveResource($rasporedNastave)]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(RasporedNastave $rasporedNastave)
    {
        return new RasporedNastaveResource($rasporedNastave);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RasporedNastave $rasporedNastave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RasporedNastave $rasporedNastave)
    {
        $validator = Validator::make($request->all(), [
            'naziv_rasporeda' => 'required|string|max:255',
            'datum_od' => 'required|date',
            'datum_do' => 'required|date|after:datum_od',
            'grupa_za_nastavu_id' => 'required|integer',
            'korisnik_id' => 'required|integer'
            ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri azuriranju rasporeda za nastavu!', $validator->errors()]);
        }

        $rasporedNastave->naziv_rasporeda = $request->naziv_rasporeda;
        

        $rasporedNastave->save();

        return response()->json(['Raspored nastave je azuriran!', new RasporedNastaveResource($rasporedNastave)]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rasporedNastave = RasporedNastave::find($id);
        if ($rasporedNastave) {
            $rasporedNastave->delete();
            return response()->json(['Uspesno ste obrisali raspored nastave!', new RasporedNastaveResource($rasporedNastave)]);
        }
        else {
            return response()->json('Raspored nastave koji zelite da obrisete ne postoji u bazi!');
        } 
    }
}
