<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarRegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create']);

// Route::resource('/listing', ListingController::class)->only(['create', 'store', 'edit', 'update'])->middleware('auth');

// Route::resource('/listing', ListingController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::resource('/listing', ListingController::class)->middleware('auth');

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

Route::get('/listing/create/{registrationNo}', [CarController::class, 'search']);
Route::get('/listing/create/show/{registrationNo}', [CarController::class, 'show']);

Route::get('statistics/user-statistics', [StatisticsController::class, 'userStatistics'])->name('user-statistics');

Route::get('/user-statistics/monthly-count/{year}', [StatisticsController::class, 'countListingsByMonth']);
Route::get('/user-statistics/quarterly-count/{year}', [StatisticsController::class, 'countListingsByQuarter']);
Route::get('/user-statistics/yearly-count', [StatisticsController::class, 'countListingsByYear']);
Route::get('/user-statistics/expiring-count', [StatisticsController::class, 'countExpiringListings']);
Route::get('/user-statistics/registered-count', [StatisticsController::class, 'countRegisteredCars']);

Route::get('car-register', [CarRegisterController::class, 'index'])->name('car-register');
Route::post('car-register', [CarRegisterController::class, 'import'])->name('car-import');

//->name('cars.search');
