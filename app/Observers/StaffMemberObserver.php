<?php

namespace App\Observers;

use App\Models\StaffMember;
use App\Services\Models\Events\StaffMemberEventService;

class StaffMemberObserver
{
    public function created(StaffMember $staffMember): void
    {
        $service = new StaffMemberEventService($staffMember);

        $service->createInfo();
    }
}
