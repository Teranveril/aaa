<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::prefix('pets')->group(function () {
    // API: Lista zwierząt
    Route::get('/', [PetController::class, 'index']);

    // API: Szczegóły
    Route::get('/{id}', [PetController::class, 'show']);

    // API: Tworzenie
    Route::post('/', [PetController::class, 'store']);

    // API: Aktualizacja
    Route::put('/{id}', [PetController::class, 'update']);

    // API: Usuwanie
    Route::delete('/{id}', [PetController::class, 'destroy']);
});
