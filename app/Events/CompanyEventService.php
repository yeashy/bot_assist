<?php

namespace app\Events;

use App\Models\Company;
use Illuminate\Support\Str;

readonly class CompanyEventService
{
    public function __construct(
        private Company $company
    ) {}

    public function setEncodedId(): void
    {
        $this->company->encoded_id = uniqid();
    }

    public function setCodeName(): void
    {
        $this->company->code_name = Str::slug($this->company->name, '_');
    }

    public function createInfo(): void
    {
        $this->company->info()->create();
    }

    public function createDesign(): void
    {
        $this->company->design()->create();
    }
}
