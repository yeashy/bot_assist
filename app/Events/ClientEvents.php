<?php

namespace app\Events;

use App\Models\Client;
use App\Models\User;

readonly class ClientEvents
{
    public function __construct(
        private Client $client
    ) {}

    public function attachUserViaPhoneNumber(): void
    {
        if (! empty($this->client->user_phone_number)) {
            /** @var User $user */
            $user = User::query()->firstOrCreate([
                'phone_number' => $this->client->user_phone_number,
            ], [
                'name' => $this->client->full_name,
            ]);

            $user->save();
            $user->refresh();

            $this->client->user_id = $user->id;
            unset($this->client->user_phone_number);
        }
    }

    public function createInfo(): void
    {
        $this->client->info()->create();
    }
}
