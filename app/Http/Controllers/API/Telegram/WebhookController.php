<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use App\Services\Http\API\Telegram\Webhook\HandleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request, string $token): JsonResponse
    {
        $service = new HandleService($request, $token);

        return $service->execute();
    }
}
