<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\FeaturesController;

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

Route::post('register',[UserAuthController::class,'register'])->name('register');
Route::post('login',[UserAuthController::class,'login'])->name('login');
Route::post('logout',[UserAuthController::class,'logout'])->name('logout')->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('reads', ReadController::class);

    Route::get('warnings/{userId}/{vehicleId?}', [FeaturesController::class, 'warnings'])->name('warnings');
    Route::get('last-week/{userId}/{vehicleId?}', [FeaturesController::class, 'lastWeek'])->name('lastWeek');
    Route::get('averages/{userId}/{vehicleId?}', [FeaturesController::class, 'averagesAndMessages'])->name('averagesAndMessages');
});
