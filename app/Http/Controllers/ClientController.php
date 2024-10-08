<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\RegisterRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Services\Http\Client\RegisterService;
use App\Services\Http\Client\UpdateService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function register(RegisterRequest $request, int $companyId): JsonResponse
    {
        $service = new RegisterService($request, $companyId);

        return $service->execute();
    }

    public function update(UpdateRequest $request, int $companyId): JsonResponse
    {
        $service = new UpdateService($request, $companyId);

        return $service->execute();
    }
}
