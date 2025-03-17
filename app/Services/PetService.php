<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.petstore.url');
    }

    // Unified error handling
    private function handleResponse($response)
    {
        if ($response->failed()) {
            Log::error("PetStore API Error: {$response->body()}");
            throw new \Exception("API request failed: {$response->status()}");
        }

        return $response->json();
    }

    // All CRUD methods
    public function createPet(array $data)
    {
        $response = Http::post("{$this->baseUrl}/pet", $data);
        return $this->handleResponse($response);
    }

    public function getPet(int $id)
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");
        return $this->handleResponse($response);
    }

    public function updatePet(int $id, array $data)
    {
        $response = Http::put("{$this->baseUrl}/pet/{$id}", $data);
        return $this->handleResponse($response);
    }

    public function deletePet(int $id)
    {
        $response = Http::delete("{$this->baseUrl}/pet/{$id}");
        return $this->handleResponse($response);
    }

    public function listPets(string $status = 'available')
    {
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", ['status' => $status]);
        return $this->handleResponse($response);
    }
}
