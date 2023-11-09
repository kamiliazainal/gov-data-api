<?php

use App\Http\Controllers\api\FuelPriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('fuel-price')
       ->name('fuel-price.')
       ->group(function () {
            Route::get('/', [FuelPriceController::class, 'index']);
            Route::get('ron95', [FuelPriceController::class, 'ron95']);
            Route::get('ron97', [FuelPriceController::class, 'ron97']);
            Route::get('diesel', [FuelPriceController::class, 'diesel']);
       });


