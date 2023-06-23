<?php

use App\Http\Controllers\Frontend\TravelToursController;
use App\Http\Controllers\Frontend\TravelController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([], function () {
   Route::resource('travels', TravelController::class)->only(['index']);

   Route::resource('travels/{travelSlug}/tours', TravelToursController::class)->only(['index']);
});
