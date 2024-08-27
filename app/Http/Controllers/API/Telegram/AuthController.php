<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use App\Services\Http\API\Telegram\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(Request $request, int $companyId): JsonResponse
    {
        $service = new AuthService(
            $request,
            $companyId
        );

        return $service->execute();
    }
}
