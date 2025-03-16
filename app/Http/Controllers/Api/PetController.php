<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetApiService;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petApiService;

    public function __construct(PetApiService $petApiService)
    {
        $this->petApiService = $petApiService;
    }
    public function index() {
        $client = new Client();
        $response = $client->get('https://petstore.swagger.io/v2/pet/findByStatus', [
            'query' => ['status' => 'available']
        ]);
        $pets = json_decode($response->getBody());
        return view('pets.index', ['pets' => $pets]);
    }

}
