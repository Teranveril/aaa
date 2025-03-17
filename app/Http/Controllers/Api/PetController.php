<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetService;

class PetController extends Controller {
    public function __construct(
        protected PetService $petService
    ) {}

    public function index() {
        $pets = $this->petService->getPetsByStatus('available');
        return response()->json($pets);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:available,pending,sold'
        ]);

        $pet = $this->petService->createPet($validated);
        return response()->json($pet, 201);
    }

    public function show(string $id)
    {
        $pet = $this->petService->getPetById($id);
        return response()->json($pet);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'string',
            'status' => 'in:available,pending,sold'
        ]);

        $pet = $this->petService->updatePet($id, $validated);
        return response()->json($pet);
    }

    public function destroy(string $id)
    {
        $this->petService->deletePet($id);
        return response()->noContent();
    }
}
