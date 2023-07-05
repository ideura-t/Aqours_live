<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AqoursController;
use App\Http\Controllers\LiveController;

Route::get('/', [AqoursController::class, 'index']);

Route::get('/dashboard', [AqoursController::class, 'index'])->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';


Route::group(['middleware' => ['auth']], function () {
    Route::resource('Aqours', AqoursController::class, ['only' => ['store', 'destroy', 'create', 'show', 'edit', 'update']]);
    Route::get('/songs/{song}', [AqoursController::class, 'song'])->name('Aqours.song');
    Route::get('/live/{id}', [LiveController::class, 'show'])->name('live.show');
    Route::get('/live', [LiveController::class, 'live'])->name('live.live');
    Route::get('Aqours', [LiveController::class, 'index'])->name('Aqours.index');
});