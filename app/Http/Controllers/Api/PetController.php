<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetApiService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petApiService;

    public function __construct(PetApiService $petApiService)
    {
        $this->petApiService = $petApiService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $pets = $this->petApiService->getPets();
            return response()->json($pets);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $this->getStatusCodeFromException($e));
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $pet = $this->petApiService->createPet($request->all());
            return response()->json($pet, 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $this->getStatusCodeFromException($e));
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {
            $pet = $this->petApiService->getPetById($id);
            return response()->json($pet);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $this->getStatusCodeFromException($e));
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $pet = $this->petApiService->updatePet($id, $request->all());
            return response()->json($pet);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $this->getStatusCodeFromException($e));
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->petApiService->deletePet($id);
            return response()->json(['message' => 'Zwierzę zostało usunięte']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $this->getStatusCodeFromException($e));
        }
    }

    protected function getStatusCodeFromException(\Exception $e)
    {
        $previous = $e->getPrevious();
        return $previous && method_exists($previous, 'response') ? $previous->response()->status() : 500;
    }
}
