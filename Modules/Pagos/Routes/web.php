<?php
use Modules\Alumnos\Http\Controllers\AlumnosController;
use Modules\Pagos\Http\Controllers\PagosController;
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

Route::prefix('pagos')->group(function() {
    Route::get('/', [AlumnosController::class, 'index'])->name('studentIndexList');
    Route::get('/{id}', [PagosController::class, 'index'])->name('paymentStudentList');
    Route::get('/{id}/registro', [PagosController::class, 'create'])->name('createPayment');
    Route::put('/{id}/registro', [PagosController::class, 'store']);

});
