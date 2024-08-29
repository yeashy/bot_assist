<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\RegisterRequest;
use App\Services\Http\Client\RegisterService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function register(RegisterRequest $request, int $companyId): JsonResponse
    {
        $service = new RegisterService($request, $companyId);

        return $service->execute();
    }
}
