<?php

namespace App\Observers;

use app\Events\CompanyAffiliateEventService;
use App\Models\CompanyAffiliate;

class CompanyAffiliateObserver
{
    public function saving(CompanyAffiliate $companyAffiliate): void
    {
        $service = new CompanyAffiliateEventService($companyAffiliate);

        $service->setIsMainForOnlyThatAffiliate();
    }
}
