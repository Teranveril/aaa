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
            session()->put('user_tag', $currentTag);

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
            'name' => 'required',
            'status' => 'required|in:available,pending,sold',
            'photoUrls' => 'required|array',
            'user_tag' => 'required|string' // Dodaj to pole
        ]);

        try {
            $this->petService->createPet($validated, $validated['user_tag']);
            return redirect()->route('web.pets.index')->with('success', 'Pet created!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pet = $this->petService->getPet($id);
            return view('pets.edit', compact('pet'));
        } catch (\Exception $e) {
            return redirect()->route('web.pets.index')
                ->with('error', 'Cannot edit pet from other category');
        }
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => (int)$id]);

        $validated = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photoUrls' => 'required'
        ]);

        // Przetwórz URL-e zdjęć
        $validated['photoUrls'] = array_filter(
            explode("\n", $validated['photoUrls'])
        );

        try {
            $userTag = session('user_tag', 'default_tag');
            $this->petService->updatePet($id, $validated, $userTag);
            return redirect()->route('web.pets.index')->with('success', 'Pet updated!');
        } catch (\Exception $e) {
            \Log::error('Full update error:', [
                'exception' => $e,
                'input' => $request->all()
            ]);
            return back()->withInput()->with('error', 'Error: '.$e->getMessage());
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
