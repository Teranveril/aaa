<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetStoreService
{
    protected string $baseUrl;
    protected string $hardCategoryName = 'CUSTOM_LARAVEL_APP_PETS'; // Stała nazwa kategorii

    public function __construct()
    {
        $this->baseUrl = config('services.petstore.url');
    }

    public function createPet(array $data): array
    {
        $payload = [
            'name' => $data['name'],
            'status' => $data['status'],
            'photoUrls' => $data['photoUrls'],
            'category' => [
                'id' => 987654321, // Stałe ID kategorii
                'name' => $this->hardCategoryName
            ]
        ];

        $response = Http::post("{$this->baseUrl}/pet", $payload);
        return $this->handleResponse($response);
    }

    public function getAllPets(): array
    {
        try {
            $response = Http::get("{$this->baseUrl}/pet/findByStatus", [
                'status' => 'available'
            ]);

            $allPets = $this->handleResponse($response);

            // Filtruj tylko nasze pets po kategorii
            return array_filter($allPets, function ($pet) {
                return isset($pet['category']['name']) &&
                    $pet['category']['name'] === $this->hardCategoryName;
            });

        } catch (\Exception $e) {
            // Logowanie błędów
            return [];
        }
    }

    public function updatePet(int $id, array $data): array
    {
        // Pobierz aktualną kategorię
        $currentPet = $this->getPet($id);

        $payload = [
            'id' => $id,
            'name' => $data['name'],
            'status' => $data['status'],
            'photoUrls' => $data['photoUrls'],
            'category' => $currentPet['category'] // Zachowaj istniejącą kategorię
        ];

        $response = Http::put("{$this->baseUrl}/pet", $payload);
        return $this->handleResponse($response);
    }

    private function handleResponse($response)
    {
        if ($response->failed()) {
            throw new \Exception("API Error: " . $response->body());
        }
        return $response->json();
    }
    public function getPet(int $id)
    {
        $pet = Http::get("{$this->baseUrl}/pet/{$id}")->json();

        if (!isset($pet['category']['name']) ||
            $pet['category']['name'] !== $this->hardCategoryName
        ) {
            throw new \Exception("Pet not found in our system");
        }

        return $pet;
    }
}
