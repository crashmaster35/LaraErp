<?php
use Modules\Grupos\Http\Controllers\GruposController;

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

Route::prefix('grupos')->group(function() {
    Route::get('/', [GruposController::class, 'index'])->name('showGroupsList');
    Route::get('/registro', [GruposController::class, 'create'])->name('createGroups');
    Route::put('/registro', [GruposController::class, 'store']);
    Route::get('/{id}', [GruposController::class, 'show'])->name('showGroups');
    Route::post('/{id}', [GruposController::class, 'update']);
});
