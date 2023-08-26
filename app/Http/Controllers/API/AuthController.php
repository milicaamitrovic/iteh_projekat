<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()
            ->json(['message'=>'Pogresni kredencijali za logovanje.'],401);
        }
        $user=User::where('email',$request['email'])->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()
        ->json(['message'=>'Zdravo, '.$user->ime.', uspesno ste se prijavili!','access_token'=>$token,'token_type'=>'Bearer', ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return [
    
            'message'=>"Uspesno ste se odjavili i vas token je izbrisan."
        ];
    }
}
