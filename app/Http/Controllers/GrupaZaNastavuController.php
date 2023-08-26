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
        return $grupe;
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

        $grupaZaNastavu = GrupaZaNastavu::create([
            'naziv_grupe' => $request->naziv_grupe
         ]);

         return response()->json(['Grupa za nastavu je dodata!', new GrupaZaNastavuResource($grupaZaNastavu)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GrupaZaNastavu $grupaZaNastavu)
    {
        return new GrupaZaNastavuResource($grupaZaNastavu);
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
    public function update(Request $request, GrupaZaNastavu $grupaZaNastavu)
    {
        $validator = Validator::make($request->all(), [
            'naziv_grupe' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri azuriranju grupe za nastavu!', $validator->errors()]);
        }

        $grupaZaNastavu->naziv_grupe = $request->naziv_grupe;
        

        $grupaZaNastavu->save();

        return response()->json(['Grupa za nastavu je azurirana!', new GrupaZaNastavuResource($grupaZaNastavu)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grupaZaNastavu = GrupaZaNastavu::find($id);
        if ($grupaZaNastavu) {
            $grupaZaNastavu->delete();
            return response()->json(['Uspesno ste obrisali grupu za nastavu!', new GrupaZaNastavuResource($grupaZaNastavu)]);
        }
        else {
            return response()->json('Grupa za nastavu koju zelite da obrisete ne postoji u bazi!');
        } 
    }
}
