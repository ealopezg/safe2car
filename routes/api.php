<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleDeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('vehicle')->name('api.vehicle.')->group(function (){
    Route::post('/alive',[VehicleDeviceController::class, 'alive'])->name('alive');
    Route::post('/ok',[VehicleDeviceController::class, 'ok'])->name('ok');
    Route::post('/action',[VehicleDeviceController::class, 'action'])->name('action');
    Route::get('/state',[VehicleDeviceController::class, 'getState'])->name('state');
});
