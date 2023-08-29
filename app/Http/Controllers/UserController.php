<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
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
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'broj_indeksa' => 'required|string|max:9',
            'email' => 'required|email',
            'password' => 'required|string',
            'administrator' => 'required|boolean',
            'grupa_za_nastavu_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri validaciji!', $validator->errors()]);
        }

        $user = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'broj_indeksa' => $request->broj_indeksa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'administrator' => $request->administrator,
            'grupa_za_nastavu_id' => $request->grupa_za_nastavu_id,
        ]);

        return response()->json(['Korisnik je dodat!', new UserResource($user)]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json('Korisnik sa trazenim id-jem ne postoji.');
        }
    }

    public function searchByBrojIndeksa(Request $request)
    {
        $brojIndeksa = $request->input('broj_indeksa');

        $user = User::where('broj_indeksa', $brojIndeksa)->first();

        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json('Korisnik sa trazenim brojem indeksa ne postoji.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (is_null($user)) {

           return response()->json('Korisnika koga zelite da azurirate ne postoji!');
        }
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'broj_indeksa' => 'required|string|max:9',
            'email' => 'required|email',
            'password' => 'required|string',
            'administrator' => 'required|boolean',
            'grupa_za_nastavu_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri azuriranju korisnika!', $validator->errors()]);
        }

        $user->ime = $request->ime;
        $user->prezime = $request->prezime;
        $user->broj_indeksa = $request->broj_indeksa;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->administrator = $request->administrator;
        $user->grupa_za_nastavu_id = $request->grupa_za_nastavu_id;

        $user->save();

        return response()->json(['Korisnik je azuriran!', new UserResource($user)]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['Uspesno ste obrisali korisnika!', new UserResource($user)]);
        }
        else {
            return response()->json('Korisnik koga zelite da obrisete ne postoji!');
        } 
    }
}
