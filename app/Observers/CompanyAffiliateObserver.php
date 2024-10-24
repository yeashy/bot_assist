<?php

namespace App\Observers;

use app\Events\CompanyAffiliateEvents;
use App\Models\CompanyAffiliate;

final class CompanyAffiliateObserver
{
    public function saving(CompanyAffiliate $companyAffiliate): void
    {
        $events = new CompanyAffiliateEvents($companyAffiliate);

        $events->setIsMainForOnlyThatAffiliate();
    }
}
