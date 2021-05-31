<?php

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

/* this is the route for the main pages of the module */
Route::prefix('warehouse')->group(function() {
    Route::get('/', 'WarehouseController@index');

    /* This is the config page for the module */
    Route::prefix('settings')->group(function() {
      Route::get('/', 'WarehouseController@settings');
      Route::post('/', 'WarehouseController@setSettings');
    });

});

