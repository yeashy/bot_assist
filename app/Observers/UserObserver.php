<?php

namespace App\Observers;

use app\Events\UserEvents;
use App\Models\User;

final class UserObserver
{
    public function saving(User $user): void
    {
        $events = new UserEvents($user);

        $events->adaptPhoneNumber();
    }
}
