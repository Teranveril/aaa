<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PetController;

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('pets.index');
    Route::get('/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/', [PetController::class, 'store'])->name('pets.store');
    Route::get('/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/{id}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('pets.destroy');
});
