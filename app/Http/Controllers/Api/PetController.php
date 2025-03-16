<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petApiService;

    public function __construct(PetApiService $petApiService)
    {
        $this->petApiService = $petApiService;
    }
    public function index(Request $request): JsonResponse
    {
        try {
            $status = $request->query('status', 'available');
            $pets = $this->petApiService->getPetsByStatus($status);
            return response()->json($pets);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
