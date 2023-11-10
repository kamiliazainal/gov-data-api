<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chartjs', function () {
    return view('chartjs');
});

Route::prefix('fuel-price')
       ->name('fuel-price.')
       ->group(function () {
            Route::get('/', function () {
                return view('fuel-price');
            });
       });
