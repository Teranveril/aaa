<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PetController;

Route::prefix('pets')->name('web.pets.')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('index');
    Route::get('/create', [PetController::class, 'create'])->name('create');
    Route::post('/', [PetController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PetController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PetController::class, 'update'])->name('update');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy');
});
