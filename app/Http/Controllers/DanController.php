<?php

namespace App\Http\Controllers;

use App\Models\Dan;
use App\Http\Resources\DanResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dan = Dan::all();
        return DanResource::collection($dan);
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
        $dan = Dan::find($id);

        if ($dan) {

           return new DanResource($dan);

        } else {

           return response()->json('Dan sa trazenim id-jem ne postoji.');

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dan $dan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dan $dan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dan $dan)
    {
        //
    }
}
