<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PetStoreService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetStoreService $petService)
    {
        $this->petService = $petService;
    }

    public function index(Request $request)
    {
        try {
            $currentTag = $request->input('tag', session('user_tag', 'default_tag'));
            $pets = $this->petService->getAllPets($currentTag);

            return view('pets.index', [
                'pets' => $pets,
                'currentTag' => $currentTag
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photoUrls' => 'required|array',
            'photoUrls.*' => 'url',
            'user_tag' => 'required|string|max:50'
        ]);

        try {
            $this->petService->createPet($validated, $validated['user_tag']);
            return redirect()->route('web.pets.index')->with('success', 'Pet created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pet = $this->petService->getPetById($id);
            return view('pets.edit', compact('pet'));
        } catch (\Exception $e) {
            return redirect()->route('web.pets.index')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photoUrls' => 'required|array',
            'photoUrls.*' => 'url'
        ]);

        try {
            $this->petService->updatePet($id, $validated);
            return redirect()->route('web.pets.index')->with('success', 'Pet updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->petService->deletePet($id);
            return redirect()->route('web.pets.index')->with('success', 'Pet deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
