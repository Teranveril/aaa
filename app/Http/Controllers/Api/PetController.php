<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller {
    protected $petService;

    public function __construct(PetService $petService) {
        $this->petService = $petService;
    }

    // Pobierz zwierzęta (JSON)
    public function index() {
        try {
            $pets = $this->petService->getPetsByStatus('available');
            return response()->json($pets);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Dodaj zwierzę (POST)
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:available,pending,sold'
        ]);

        try {
            $pet = $this->petService->createPet($validated);
            return response()->json($pet, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
