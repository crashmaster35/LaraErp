<?php
use Modules\Planteles\Http\Controllers\CampusesController;

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
    Route::prefix('planteles')->group(function() {
        Route::get('/', [CampusesController::class, 'index'])->name('showCampusList');
        Route::get('/registro', [CampusesController::class, 'create'])->name('createCampus');
        Route::put('/registro', [CampusesController::class, 'store']);
        Route::get('/{id}', [CampusesController::class, 'show'])->name('showCampus');
        Route::post('/{id}', [CampusesController::class, 'update']);
    });
});
