<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller {
    protected $petService;

    public function __construct(PetService $petService) {
        $this->petService = $petService;
    }

    // Lista zwierząt (widok)
    public function index() {
        try {
            $pets = $this->petService->getPetsByStatus('available');
            return view('pets.index', ['pets' => $pets]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Formularz dodawania
    public function create() {
        return view('pets.create');
    }

    // Zapisz zwierzę (POST)
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:available,pending,sold'
        ]);

        try {
            $this->petService->createPet($validated);
            return redirect()->route('pets.index')->with('success', 'Dodano!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
