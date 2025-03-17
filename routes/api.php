<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::prefix('api')->group(function () {
    // GET /api/pets - lista wszystkich zwierząt
    Route::get('/pets', [PetController::class, 'index']);

    // POST /api/pets - dodaj nowe zwierzę
    Route::post('/pets', [PetController::class, 'store']);

    // GET /api/pets/{id} - szczegóły zwierzęcia
    Route::get('/pets/{id}', [PetController::class, 'show']);

    // PUT /api/pets/{id} - aktualizuj zwierzę
    Route::put('/pets/{id}', [PetController::class, 'update']);

    // DELETE /api/pets/{id} - usuń zwierzę
    Route::delete('/pets/{id}', [PetController::class, 'destroy']);
});
