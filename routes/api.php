<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupaZaNastavuController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RasporedNastaveController;
use App\Http\Controllers\RasporedStavkeRasporedaController;
use App\Http\Controllers\EvidencijaPrisustvaController;


Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/profile', function(Request $request){
        return auth()->user();
    });

    Route::post('/evidencije', [EvidencijaPrisustvaController::class, 'store']);

    Route::get('/stavkeRasporeda/{id}', [RasporedStavkeRasporedaController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout']);   
});


Route::middleware(['auth:sanctum','daLiJeAdministrator'])->group(function(){  

    Route::get('/check', function(){
        return response()->json(['message'=>'Administrator je ulogovan.'],200);
    });

    Route::resource('users', UserController::class);
    Route::resource('grupe', GrupaZaNastavuController::class);
    Route::resource('rasporedi', RasporedNastaveController::class);

    Route::get('/evidencije', [EvidencijaPrisustvaController::class, 'index']);
    Route::get('/evidencije/{id}', [EvidencijaPrisustvaController::class, 'show']);

    Route::get('/user/search', [UserController::class, 'searchByBrojIndeksa'])->name('user.search');
    Route::get('/raspored/search', [RasporedNastaveController::class, 'searchByNazivRasporeda'])->name('raspored.search');
 
});