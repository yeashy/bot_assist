<?php

namespace App\Services\Http\Client;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateService
{
    private array $userUpdateFields = [
        'phone_number'
    ];

    public function __construct(
        private readonly Request $request,
        private readonly int $companyId
    ) {}

    public function execute(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $client = $user->client($this->companyId);

        $this->updateUser($user);
        $this->updateClient($client);

        return response()->json([
            'message' => 'success'
        ]);
    }

    private function updateUser(User $user): void
    {
        $updateFields = [
            'phone_number'
        ];

        $this->updateEntity($user, $updateFields);
    }

    private function updateClient(Client $client): void
    {
        $updateFields = [
            'name',
            'surname',
            'patronymic'
        ];

        $this->updateEntity($client, $updateFields);
    }

    private function updateEntity(Model $entity, array $fields = []): void
    {
        foreach ($fields as $field) {
            if ($this->request->has($field)) {
                $entity->{$field} = $this->request->get($field);
            }
        }

        $entity->save();
    }
}
