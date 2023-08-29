<?php

namespace App\Http\Controllers;

use App\Models\GrupaZaNastavu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GrupaZaNastavuResource;

class GrupaZaNastavuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupe = GrupaZaNastavu::all();
        return GrupaZaNastavuResource::collection($grupe);
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
            'naziv_grupe' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri validaciji!', $validator->errors()]);
        }

        $grupa_za_nastavu = GrupaZaNastavu::create([
            'naziv_grupe' => $request->naziv_grupe
        ]);

        return response()->json(['Grupa za nastavu je dodata!', new GrupaZaNastavuResource($grupa_za_nastavu)]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $grupa_za_nastavu = GrupaZaNastavu::find($id);

        if ($grupa_za_nastavu) {

           return new GrupaZaNastavuResource($grupa_za_nastavu);

        } else {

           return response()->json('Grupa za nastavu sa trazenim id-jem ne postoji.');

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrupaZaNastavu $grupaZaNastavu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $grupa_za_nastavu = GrupaZaNastavu::find($id);

        if (is_null($grupa_za_nastavu)) {

           return response()->json('Grupa za nastavu koju zelite da azurirate ne postoji!');
        }


        $validator = Validator::make($request->all(), [
            'naziv_grupe' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri azuriranju grupe za nastavu!', $validator->errors()]);
        }

        $grupa_za_nastavu->naziv_grupe = $request->naziv_grupe;
        

        $grupa_za_nastavu->save();

        return response()->json(['Grupa za nastavu je azurirana!', new GrupaZaNastavuResource($grupa_za_nastavu)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grupa_za_nastavu = GrupaZaNastavu::find($id);
        if ($grupa_za_nastavu) {
            $grupa_za_nastavu->delete();
            return response()->json(['Uspesno ste obrisali grupu za nastavu!', new GrupaZaNastavuResource($grupa_za_nastavu)]);
        }
        else {
            return response()->json('Grupa za nastavu koju zelite da obrisete ne postoji!');
        } 
    }
}
