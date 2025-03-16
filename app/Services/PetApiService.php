<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class PetApiService
{
    protected $baseUrl = 'https://petstore.swagger.io/v2';
    public function getPetsByStatus(string $status = 'available')
    {
        try {
            $response = Http::get($this->baseUrl . '/pet/findByStatus', [
                'status' => $status,
            ]);
            $response->throw();
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas pobierania listy zwierząt po statusie: ' . $e->getMessage(), $e->response ? $e->response->status() : 500);
        }
    }
}
