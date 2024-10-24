<?php

namespace App\Observers;

use app\Events\ClientEvents;
use App\Models\Client;

final class ClientObserver
{
    public function creating(Client $client): void
    {
        $events = new ClientEvents($client);

        $events->attachUserViaPhoneNumber();
    }

    public function created(Client $client): void
    {
        $events = new ClientEvents($client);

        $events->createInfo();
    }
}
