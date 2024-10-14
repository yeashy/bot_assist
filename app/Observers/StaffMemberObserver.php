<?php

namespace App\Observers;

use app\Events\StaffMemberEventService;
use App\Models\StaffMember;

class StaffMemberObserver
{
    public function created(StaffMember $staffMember): void
    {
        $service = new StaffMemberEventService($staffMember);

        $service->createInfo();
    }
}
