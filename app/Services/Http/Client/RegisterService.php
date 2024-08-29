<?php

namespace App\Services\Http\Client;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class RegisterService
{
    public function __construct(
        private Request $request,
        private int     $companyId
    ) {}

    public function execute(): JsonResponse
    {
        $user = $this->saveUser();

        $this->saveClient($user);

        return response()->json([
            'message' => 'success'
        ]);
    }

    private function saveUser(): User
    {
        /** @var User $user */
        $user = Auth::user();

        $user->phone_number = $this->request->get('phone_number');
        $user->save();

        return $user;
    }

    private function saveClient(User $user): void
    {
        $client = new Client();

        $client->name = $this->request->get('name');
        $client->surname = $this->request->get('surname');
        $client->patronymic = $this->request->get('patronymic');
        $client->company_id = $this->companyId;
        $client->user_id = $user->id;

        $client->save();
    }
}
