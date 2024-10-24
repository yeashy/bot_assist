<?php

namespace App\Observers;

use app\Events\StaffMemberEvents;
use App\Models\StaffMember;

final class StaffMemberObserver
{
    public function created(StaffMember $staffMember): void
    {
        $events = new StaffMemberEvents($staffMember);

        $events->createInfo();
    }
}
