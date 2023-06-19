<?php
use Illuminate\Support\Facades\Route;
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
Route::middleware(['auth'])->group(function() {
    Route::prefix('bajas')->group(function() {
        Route::get('/', 'BajasController@index');
        Route::get('/{id}', 'BajasController@edit');
        Route::get('/{id}/baja', 'BajasController@destroy');
    });
});
