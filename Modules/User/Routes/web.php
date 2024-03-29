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

Route::middleware(['auth'])->group(function() {
    /* this is the route for the main pages of the module */
    Route::prefix('user')->group(function() {
        Route::get('/', 'UserController@index');

        /* This is the config page for the module */
        Route::prefix('settings')->group(function() {
            Route::get('/', 'UserController@settings');
        });
    });
});