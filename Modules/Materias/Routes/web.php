<?php
use Modules\Materias\Http\Controllers\MateriasController;
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
    Route::prefix('materias')->group(function() {
        Route::get('/', [MateriasController::class, 'index']);
        Route::get('/curso/{cid}', [MateriasController::class, 'getClasses'])->name('showClassesList');
        Route::get('/curso/{cid}/materia/crear', [MateriasController::class, 'create']);
        Route::put('/curso/{cid}/materia/crear', [MateriasController::class, 'store']);
        Route::get('/curso/{cid}/materia/{mid}', [MateriasController::class, 'show']);
        Route::post('/curso/{cid}/materia/{mid}', [MateriasController::class, 'update']);
    });
});
