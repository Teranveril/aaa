<?php

use App\Services\PetApiService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetWebController;
use App\Http\Controllers\Api\PetController as ApiPetController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/pets')->group(function () {
    Route::get('/', [ApiPetController::class, 'index']);
    Route::post('/', [ApiPetController::class, 'store']);
    Route::get('/{id}', [ApiPetController::class, 'show']);
    Route::put('/{id}', [ApiPetController::class, 'update']);
    Route::delete('/{id}', [ApiPetController::class, 'destroy']);
});

Route::resource('pets', PetWebController::class);

Route::get('/test-swagger', function () {
    $petApiService = new PetApiService();
    try {
        $inventory = $petApiService->getPets(); // Teraz getPets() pobiera inwentarz
        dd($inventory);
    } catch (\Exception $e) {
        dd('Wystąpił błąd: ' . $e->getMessage());
    }
});
