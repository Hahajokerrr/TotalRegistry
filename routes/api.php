<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\StatisticsController;
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


Route::get('/user-statistics/monthly-count/{year}', [StatisticsController::class, 'countListingsByMonth']);
Route::get('/user-statistics/quarterly-count/{year}', [StatisticsController::class, 'countListingsByQuarter']);
Route::get('/user-statistics/yearly-count', [StatisticsController::class, 'countListingsByYear']);
