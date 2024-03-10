<?php

namespace App\Observers;

use App\Models\Company;
use Str;

class CompanyObserver
{
    public function creating(Company $company): void
    {
        $company->encoded_id = uniqid();
        $company->code_name = Str::slug($company->name, '_');
    }
}
