<?php

namespace App\Http\Controllers;

use App\Models\GrupaZaNastavu;
use Illuminate\Http\Request;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrupaZaNastavu $grupaZaNastavu)
    {
        //
    }
}