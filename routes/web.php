<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PetController;

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('pets.index');
    Route::get('/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/', [PetController::class, 'store'])->name('pets.store');
});
