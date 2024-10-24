<?php

namespace app\Events;

use App\Models\CompanyAffiliate;

readonly class CompanyAffiliateEvents
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
