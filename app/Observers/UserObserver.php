<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Models\Events\UserEventService;

class UserObserver
{
    public function saving(User $user): void
    {
        $service = new UserEventService($user);

        $service->adaptPhoneNumber();
    }
}
