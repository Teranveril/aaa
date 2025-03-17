<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetStoreService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.petstore.url');
    }

    private function handleResponse($response)
    {
        if ($response->failed()) {
            $error = "PetStore API Error: {$response->status()} - {$response->body()}";
            Log::error($error);
            throw new \Exception($error);
        }
        return $response->json();
    }

    public function getAllPets()
    {
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", ['status' => 'available']);
        return $this->handleResponse($response);
    }

    public function getPetById($id)
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");
        return $this->handleResponse($response);
    }

    public function createPet($data)
    {
        $response = Http::post("{$this->baseUrl}/pet", $data);
        return $this->handleResponse($response);
    }

    public function updatePet($id, $data)
    {
        $response = Http::put("{$this->baseUrl}/pet/{$id}", $data);
        return $this->handleResponse($response);
    }

    public function deletePet($id)
    {
        $response = Http::delete("{$this->baseUrl}/pet/{$id}");
        return $this->handleResponse($response);
    }
}
