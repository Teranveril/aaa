<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PetController;

Route::prefix('pets')->name('web.pets.')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('index');
    Route::get('/create', [PetController::class, 'create'])->name('create');
    Route::post('/', [PetController::class, 'store'])->name('store');

    // Grupa z middleware walidującym ID
    Route::middleware('validate.pet.id')->group(function () {
        Route::get('/{id}/edit', [PetController::class, 'edit'])->name('edit')
            ->where('id', '[0-9]+');

        Route::put('/{id}', [PetController::class, 'update'])->name('update')
            ->where('id', '[0-9]+');

        Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy')
            ->where('id', '[0-9]+');
    });
});
