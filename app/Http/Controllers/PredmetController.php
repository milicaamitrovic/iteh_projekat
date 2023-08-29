<?php

namespace App\Http\Controllers;

use App\Models\Predmet;
use App\Http\Resources\PredmetResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PredmetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $predmet = Predmet::all();
        return PredmetResource::collection($predmet);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $predmet = Predmet::find($id);

        if ($predmet) {

           return new PredmetResource($predmet);

        } else {

           return response()->json('Predmet sa trazenim id-jem ne postoji.');

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Predmet $predmet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Predmet $predmet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Predmet $predmet)
    {
        //
    }
}
