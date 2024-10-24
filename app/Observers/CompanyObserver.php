<?php

namespace App\Observers;

use app\Events\CompanyEvents;
use App\Models\Company;

final class CompanyObserver
{
    public function creating(Company $company): void
    {
        $events = new CompanyEvents($company);

        $events->setEncodedId();
        $events->setCodeName();
    }

    public function created(Company $company): void
    {
        $events = new CompanyEvents($company);

        $events->createInfo();
        $events->createDesign();
    }
}
