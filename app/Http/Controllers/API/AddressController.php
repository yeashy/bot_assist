<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Http\API\Address\AddressService;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function suggest(string $value, AddressService $service): JsonResponse
    {
        $addresses = $service->suggest($value);

        return response()->json($addresses);
    }
}
