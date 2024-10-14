<?php

namespace App\Observers;

use app\Events\ClientEventService;
use App\Models\Client;

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
