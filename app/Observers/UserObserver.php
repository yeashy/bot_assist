<?php

namespace App\Observers;

use app\Events\UserEventService;
use App\Models\User;

class UserObserver
{
    public function saving(User $user): void
    {
        $service = new UserEventService($user);

        $service->adaptPhoneNumber();
    }
}
