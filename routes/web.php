<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopulationController;

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

Route::prefix('fuel-price')
    ->name('fuel-price.')
    ->group(function () {
        Route::get('/', function () {
            return view('fuel-price');
        });
    });

Route::get('/grid-layout', function () {
    return view('grid');
});

Route::get('/population', [PopulationController::class, 'index'])->name('population');
