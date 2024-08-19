<?php

namespace App\Observers;

use App\Models\CompanyAffiliate;
use App\Services\Models\Events\CompanyAffiliateEventService;

class CompanyAffiliateObserver
{
    public function saving(CompanyAffiliate $companyAffiliate): void
    {
        $service = new CompanyAffiliateEventService($companyAffiliate);

        $service->setIsMainForOnlyThatAffiliate();
    }
}
