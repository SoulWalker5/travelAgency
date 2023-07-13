<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\Frontend;
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
        Route::resource('travels', Admin\TravelController::class)->only(['store']);
    });

Route::group([], function () {
    Route::resource('travels', Frontend\TravelController::class)->only(['index']);

    Route::resource('travels/{travelSlug}/tours', Frontend\TravelToursController::class)->only(['index']);
});
