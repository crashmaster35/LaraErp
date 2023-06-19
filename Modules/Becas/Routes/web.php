<?php
use Modules\Becas\Http\Controllers\BecasController;
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
    Route::prefix('becas')->group(function() {
        Route::get('/', [BecasController::class, 'index'])->name('showDiscountList');
        Route::get('/registro', [BecasController::class, 'create'])->name('createDiscount');
        Route::put('/registro', [BecasController::class, 'store']);
        Route::get('/{id}', [BecasController::class, 'show'])->name('showDiscount');
        Route::post('/{id}', [BecasController::class, 'update']);
    });
});
