<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::get('/pets', [PetController::class, 'index']);
