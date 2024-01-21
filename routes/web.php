<?php

use App\Http\Controllers\FetchAPIRajaOngkir;
use App\Http\Controllers\LoopingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FetchAPIRajaOngkir::class, 'getAPIDataCities'])->name('postReqCity');

Route::post('/', function () {
    return view('home');
});

Route::post('/looping', [LoopingController::class, 'postLoop'])->name('postLoop');

Route::get('/api/check', [FetchAPIRajaOngkir::class, 'getAPIDatas'])->name('postReqCity');
Route::post('/api/check', [FetchAPIRajaOngkir::class, 'getAPIDatas'])->name('postReqCity');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
