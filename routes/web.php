<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RasporedNastaveController;
use App\Http\Controllers\EvidencijaPrisustvaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/raspored-nastave/pdf/{id}', [RasporedNastaveController::class, 'generatePdf'])->name('raspored.pdf');
Route::get('/statistika-prisustva', [EvidencijaPrisustvaController::class, 'prikaziStatistiku'])->name('evidencija.statistika');
