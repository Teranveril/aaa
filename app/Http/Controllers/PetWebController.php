<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetWebController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = url('/api/pets');
    }

    public function index()
    {
        try {
            \Log::info('Wywolanie PetWebController@index');
            $response = Http::get('http://localhost:8000/api/pets');
            \Log::info('Odpowiedz z API: ' . $response->body());
            $response->throw();
            $pets = $response->json();
            return view('pets.index', compact('pets'));
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return view('pets.index', ['error' => 'Nie można pobrać listy zwierząt.']);
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        try {
            $response = Http::post($this->apiBaseUrl, $request->except('_token'));
            $response->throw();
            return redirect()->route('pets.index')->with('success', 'Zwierzę dodane pomyślnie.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd podczas dodawania zwierzęcia: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/' . $id);
            $response->throw();
            $pet = $response->json();
            return view('pets.show', compact('pet'));
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Nie można znaleźć zwierzęcia o ID: ' . $id]);
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/' . $id);
            $response->throw();
            $pet = $response->json();
            return view('pets.edit', compact('pet'));
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Nie można znaleźć zwierzęcia o ID: ' . $id]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = Http::put($this->apiBaseUrl . '/' . $id, $request->except('_token', '_method'));
            $response->throw();
            return redirect()->route('pets.index')->with('success', 'Zwierzę zaktualizowane pomyślnie.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd podczas aktualizacji zwierzęcia: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->apiBaseUrl . '/' . $id);
            $response->throw();
            return redirect()->route('pets.index')->with('success', 'Zwierzę usunięte pomyślnie.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd podczas usuwania zwierzęcia: ' . $e->getMessage()]);
        }
    }
}
