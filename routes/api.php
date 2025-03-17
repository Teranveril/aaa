<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'index']);
    Route::get('/{id}', [PetController::class, 'show']);
    Route::post('/', [PetController::class, 'store']);
    Route::put('/{id}', [PetController::class, 'update']);
    Route::delete('/{id}', [PetController::class, 'destroy']);
});
