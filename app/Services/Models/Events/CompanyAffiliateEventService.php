<?php

namespace App\Services\Models\Events;

use App\Models\CompanyAffiliate;

readonly class CompanyAffiliateEventService
{
    public function __construct(
        private CompanyAffiliate $companyAffiliate
    ) {}

    public function setIsMainForOnlyThatAffiliate(): void
    {
        if ($this->companyAffiliate->is_main) {
            $affiliates = $this->companyAffiliate
                ->company
                ->affiliates()
                ->whereNot('id', $this->companyAffiliate->id);

            $affiliates->update(['is_main' => false]);
        }
    }
}
