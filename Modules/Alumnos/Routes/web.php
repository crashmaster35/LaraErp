<?php
use Modules\Alumnos\Http\Controllers\AlumnosController;
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

Route::prefix('alumnos')->group(function() {
    Route::get('/', [AlumnosController::class, 'index'])->name('showStudentList');
    Route::get('/registro', [AlumnosController::class, 'create'])->name('createStudent');
    Route::put('/registro', [AlumnosController::class, 'store']);
    Route::get('/{id}', [AlumnosController::class, 'show'])->name('showStudent');
    Route::post('/{id}', [AlumnosController::class, 'update']);
});
