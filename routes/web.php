<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TelegramController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/setup_telegram',[TelegramController::class, 'userSetupTelegram'])->name('user.telegram');
    Route::prefix('vehicle')->name('vehicle.')->group(function (){
        Route::get('/',[VehicleController::class, 'index'])->name('index');
        Route::post('/',[VehicleController::class, 'store'])->name('store');
        Route::get('/{id}',[VehicleController::class, 'show'])->name('show');
        Route::post('/{id}/invite',[VehicleController::class, 'invite'])->name('invite');
        Route::post('/{id}/action',[VehicleController::class, 'action'])->name('action');
        Route::get('/{id}/state',[VehicleController::class, 'state'])->name('state');
        Route::post('/{id}/api',[VehicleController::class, 'generateApiToken'])->name('apitoken');
        Route::get('/{id}/edit',[VehicleController::class, 'edit'])->name('edit');
        Route::get('/{id}/photo/{photo_id}',[VehicleController::class, 'downloadPhoto'])->name('downloadPhoto');
        Route::post('/{id}/delete',[VehicleController::class, 'delete'])->name('delete');
    });
});



