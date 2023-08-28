<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupaZaNastavuController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RasporedNastaveController;
use App\Http\Controllers\StavkaRasporedaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::get('/users', [UserController::class, 'index']);
//Route::get('/users/{id}', [UserController::class, 'show']);
Route::resource('users', UserController::class);
Route::resource('grupe', GrupaZaNastavuController::class);
Route::get('/user/search', [UserController::class, 'searchByBrojIndeksa'])->name('user.search');
Route::resource('rasporedi', RasporedNastaveController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/raspored/search', [RasporedNastaveController::class, 'searchByNazivRasporeda'])->name('raspored.search');

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::post('/logout',[AuthController::class,'logout']);
});*/

Route::get('/stavke', [StavkaRasporedaController::class, 'index']);
Route::get('/stavke/{id}', [StavkaRasporedaController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/profile', function(Request $request){
        return auth()->user();
    });
   

    Route::post('/logout', [AuthController::class, 'logout']);   
});