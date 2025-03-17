<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PetService {
    private $client;
    private $baseUrl = 'https://petstore.swagger.io/v2/pet';

    public function __construct() {
        $this->client = new Client();
    }

    // Pobierz zwierzęta po statusie
    public function getPetsByStatus(string $status): array {
        try {
            $response = $this->client->get("{$this->baseUrl}/findByStatus", [
                'query' => ['status' => $status]
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new \Exception("API Error: " . $e->getMessage());
        }
    }

    // Dodaj nowe zwierzę (przykład – dostosuj do API Petstore)
    public function createPet(array $data): array {
        try {
            $response = $this->client->post($this->baseUrl, [
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new \Exception("API Error: " . $e->getMessage());
        }
    }

    // ... inne metody (update, delete)
}
