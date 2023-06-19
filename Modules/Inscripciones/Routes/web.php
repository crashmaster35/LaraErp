<?php
use Modules\Inscripciones\Http\Controllers\InscripcionesController;
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
    Route::prefix('inscripciones')->group(function() {
        Route::get('/', [InscripcionesController::class, 'index']);
        Route::post('/getGroup', [InscripcionesController::class, 'getGroup']);
        Route::get('/{id}', [InscripcionesController::class, 'show'])->name('registerWizard');
        Route::post('/{id}', [InscripcionesController::class, 'update']);
        Route::post('/{id}/inscribir', [InscripcionesController::class, 'postRegister']);
    });
});

