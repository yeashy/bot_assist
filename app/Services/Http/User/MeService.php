<?php

namespace App\Services\Http\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class MeService
{
    public function __construct(
        private Request $request
    ) {}

    public function execute(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $client = $user->client($this->request->get('company_id'));

        $response = [
            'user' => $user->toArray()
        ];

        $response['user']['client'] = $client?->toArray();

        return response()->json($response);
    }
}
