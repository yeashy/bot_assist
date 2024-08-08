<?php

namespace App\Services\Models\Events;

use App\Models\Client;
use App\Models\User;

readonly class ClientEventService
{
    public function __construct(
        private Client $client
    ) {}

    public function createUserWithPhoneNumberAndAttach(): void
    {
        $user = new User();
        $user->name = $this->client->full_name;
        $user->phone_number = $this->client->user_phone_number;
        $user->save();
        $user->refresh();

        $this->client->user_id = $user->id;
        unset($this->client->user_phone_number);
    }

    public function createInfo(): void
    {
        $this->client->info()->create();
    }
}
