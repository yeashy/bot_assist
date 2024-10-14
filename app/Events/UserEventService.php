<?php

namespace app\Events;

use App\Helpers\PhoneNumberHelper;
use App\Models\User;

readonly class UserEventService
{
    public function __construct(
        private User $user
    ) {}

    public function adaptPhoneNumber(): void
    {
        if (!empty($this->user->phone_number)) {
            $this->user->phone_number = PhoneNumberHelper::getStandardFromPretty($this->user->phone_number);
        }
    }
}
