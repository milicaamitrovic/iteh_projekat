<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupaZaNastavuController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RasporedNastaveController;
use App\Http\Controllers\RasporedStavkeRasporedaController;
use App\Http\Controllers\EvidencijaPrisustvaController;
use App\Http\Controllers\DanController;
use App\Http\Controllers\PredmetController;
use App\Http\Controllers\VremenskiIntervalController;
use App\Http\Controllers\StavkaRasporedaController;
use App\Http\Controllers\DrzavniPrazniciController;

Route::post('/login', [AuthController::class, 'login']);

Route::resource('users', UserController::class);
Route::resource('grupe', GrupaZaNastavuController::class);
Route::resource('rasporedi', RasporedNastaveController::class);

Route::resource('dan', DanController::class);
Route::resource('predmet', PredmetController::class);
Route::resource('vreme', VremenskiIntervalController::class);
Route::resource('stavke', StavkaRasporedaController::class);
Route::get('/stavkeRasporeda/{id}', [RasporedStavkeRasporedaController::class, 'index']);

Route::get('/evidencije', [EvidencijaPrisustvaController::class, 'index']);
Route::get('/evidencije/{id}', [EvidencijaPrisustvaController::class, 'show']);
Route::post('/evidencije', [EvidencijaPrisustvaController::class, 'store']);
Route::get('/drzavniPraznici', [DrzavniPrazniciController::class, 'vratiDrzavnePraznike']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/profile', function(Request $request){
        return auth()->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);   
});

Route::middleware(['auth:sanctum','daLiJeAdministrator'])->group(function(){  

    Route::get('/check', function(){
        return response()->json(['message'=>'Administrator je ulogovan.'],200);
    });

    
});