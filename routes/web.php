<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pets', [PetWebController::class, 'index']);
