<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Backend\TravelController as BackendTravelController;
use App\Http\Controllers\Frontend\TravelToursController;
use App\Http\Controllers\Frontend\TravelController;
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

Route::post('/login', LoginController::class)->name('login');

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::resource('travels', BackendTravelController::class)->only(['store']);
    });

Route::group([], function () {
    Route::resource('travels', TravelController::class)->only(['index']);

    Route::resource('travels/{travelSlug}/tours', TravelToursController::class)->only(['index']);
});
