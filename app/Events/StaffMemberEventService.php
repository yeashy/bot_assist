<?php

namespace app\Events;

use App\Models\StaffMember;

readonly class StaffMemberEventService
{
    public function __construct(
        private StaffMember $staffMember
    ) {}

    public function createInfo(): void
    {
        $this->staffMember->info()->create();
    }
}
