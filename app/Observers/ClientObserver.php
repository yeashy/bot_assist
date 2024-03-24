<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function created(Client $client): void
    {
        $client->info()->create();
    }
}
