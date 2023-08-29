<?php

namespace App\Http\Controllers;

use App\Models\VremenskiInterval;
use App\Http\Resources\VremenskiIntervalResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VremenskiIntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vreme = VremenskiInterval::all();
        return VremenskiIntervalResource::collection($vreme);
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
        $vreme = VremenskiInterval::find($id);

        if ($vreme) {

           return new VremenskiIntervalResource($vreme);

        } else {

           return response()->json('Vreme sa trazenim id-jem ne postoji.');

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VremenskiInterval $vremenskiInterval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VremenskiInterval $vremenskiInterval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VremenskiInterval $vremenskiInterval)
    {
        //
    }
}
