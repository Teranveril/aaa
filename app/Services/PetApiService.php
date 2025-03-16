<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class PetApiService
{
    protected $baseUrl = 'https://petstore.swagger.io/v2';

    public function getPets()
    {
        try {
            $response = Http::get($this->baseUrl . '/store/inventory'); // Zmień endpoint na /store/inventory
            $response->throw();
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas pobierania inwentarza: ' . $e->getMessage(), $e->response ? $e->response->status() : 500);
        }
    }
//    public function getPets()
//    {
//        // Tymczasowo zwróć statyczną odpowiedź
//        return [
//            ['id' => 1, 'name' => 'Testowy pies', 'status' => 'available'],
//            ['id' => 2, 'name' => 'Testowy kot', 'status' => 'pending'],
//        ];
//    }

    public function createPet(array $data)
    {
        try {
            $response = Http::post($this->baseUrl . '/pet', $data);
            $response->throw();
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas dodawania zwierzęcia: ' . $e->getMessage(), $e->response ? $e->response->status() : 500);
        }
    }

    public function getPetById(int $id)
    {
        try {
            $response = Http::get($this->baseUrl . '/pet/' . $id);
            $response->throw();
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas pobierania zwierzęcia o ID ' . $id . ': ' . $e->getMessage(), $e->response ? $e->response->status() : 404);
        }
    }

    public function updatePet(int $id, array $data)
    {
        try {
            $response = Http::put($this->baseUrl . '/pet', array_merge(['id' => $id], $data));
            $response->throw();
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas aktualizacji zwierzęcia o ID ' . $id . ': ' . $e->getMessage(), $e->response ? $e->response->status() : 500);
        }
    }

    public function deletePet(int $id)
    {
        try {
            $response = Http::delete($this->baseUrl . '/pet/' . $id);
            $response->throw();
            return true;
        } catch (RequestException $e) {
            throw new \Exception('Błąd podczas usuwania zwierzęcia o ID ' . $id . ': ' . $e->getMessage(), $e->response ? $e->response->status() : 500);
        }
    }
}
