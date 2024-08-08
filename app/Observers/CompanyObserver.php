<?php

namespace App\Observers;

use App\Models\Company;
use App\Services\Models\Events\CompanyEventService;
use Str;

class CompanyObserver
{
    public function creating(Company $company): void
    {
        $service = new CompanyEventService($company);

        $service->setEncodedId();
        $service->setCodeName();
    }

    public function created(Company $company): void
    {
        $service = new CompanyEventService($company);

        $service->createInfo();
        $service->createDesign();
    }
}
