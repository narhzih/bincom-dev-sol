<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\PollingUnitController;

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

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::prefix('/polling-units')->group( function() {
    Route::get('/', [PollingUnitController::class, 'pollingUnits'])->name('pu');
    Route::get('/add-result/{pollingUnit}', [PollingUnitController::class, 'addNewResult'])->name('pu-add-result');
    Route::post('/add-result/{pollingUnit}', [PollingUnitController::class, 'doAddNewResult'])->name('do-pu-add-result');
    Route::get('/{pollingUnit}/result', [PollingUnitController::class, 'pollingUnitResults'])->name('pu-result');
});

Route::prefix('lgas')->group(function() {
    Route::get('/', [LgaController::class, 'lgas'])->name('lgas');
    Route::get('/get-list/{stateId}', [LgaController::class, 'getLgasUnderState']);
    Route::get('/get-calculated-result/{lgaId}', [LgaController::class, 'getLgaCalculatedResult']);
});

