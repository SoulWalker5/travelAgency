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
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::middleware('role:admin')
            ->group(function () {
                Route::post('travels', [Admin\TravelController::class, 'store'])->name('travel.store');

                Route::resource('travels/{travel}/tours', Admin\TourController::class)->only(['store']);
        });

        Route::put('travels/{travel}', [Admin\TravelController::class, 'update'])->name('travel.update');
    });

Route::group([], function () {
    Route::resource('travels', Frontend\TravelController::class)->only(['index']);

    Route::resource('travels/{travelSlug}/tours', Frontend\TravelToursController::class)->only(['index']);
});
