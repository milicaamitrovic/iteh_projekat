<?php

namespace App\Http\Controllers;

use App\Models\StavkaRasporeda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StavkaRasporedaResource;
use Illuminate\Support\Facades\Validator;

class StavkaRasporedaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'raspored_id' => 'required|integer',
            'dan_id' => 'required|integer',
            'vremenski_interval_id' => 'required|integer',
            'predmet_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri validaciji!', $validator->errors()]);
        }

        $stavkaRasporeda = StavkaRasporeda::create([
            'raspored_id' => $request->raspored_id,
            'dan_id' => $request->dan_id,
            'vremenski_interval_id' => $request->vremenski_interval_id,
            'predmet_id' => $request->predmet_id
        ]);

        return response()->json(['Stavka rasporeda nastave je dodata!', new StavkaRasporedaResource($stavkaRasporeda)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StavkaRasporeda $stavkaRasporeda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StavkaRasporeda $stavkaRasporeda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StavkaRasporeda $stavkaRasporeda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StavkaRasporeda $stavkaRasporeda)
    {
        //
    }
}
