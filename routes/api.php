<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PetController;

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'index']);
    Route::post('/', [PetController::class, 'store']);
});
