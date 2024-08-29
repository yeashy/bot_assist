<?php

namespace App\Observers;

use App\Models\Client;
use App\Services\Models\Events\ClientEventService;

class ClientObserver
{
    public function creating(Client $client): void
    {
        $service = new ClientEventService($client);

        $service->attachUserViaPhoneNumber();
    }

    public function created(Client $client): void
    {
        $service = new ClientEventService($client);

        $service->createInfo();
    }
}
