<?php
use Modules\Cursos\Http\Controllers\CursosController;
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

Route::prefix('cursos')->group(function() {
    Route::get('/', [CursosController::class, 'index'])->name('showCoursesList');
    Route::get('/registro', [CursosController::class, 'create'])->name('createCourses');
    Route::put('/registro', [CursosController::class, 'store']);
    Route::get('/{id}', [CursosController::class, 'show'])->name('showCourses');
    Route::post('/{id}', [CursosController::class, 'update']);
});
