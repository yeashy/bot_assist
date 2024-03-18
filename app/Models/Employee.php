<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    public function person(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(CompanyAffiliate::class);
    }

    public function periods(): HasMany
    {
        return $this->hasMany(EmployeeWorkingPeriod::class);
    }
}
