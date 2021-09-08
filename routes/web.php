<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
    Route::get('/', [PagesController::class, 'pollingUnits'])->name('pu');
    Route::get('/{pollingUnit}/result', [PagesController::class, 'pollingUnitResults'])->name('pu-result');
});
