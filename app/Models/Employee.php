<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use CrudTrait;
    use HasFactory;

    // RELATIONS

    public function person(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class, 'staff_member_id', 'id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id', 'id');
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(CompanyAffiliate::class, 'company_affiliate_id', 'id');
    }

    public function periods(): HasMany
    {
        return $this->hasMany(EmployeeWorkingPeriod::class);
    }

    // ACCESSORS

    public function getFullNameAttribute()
    {
        return $this->person->full_name;
    }
}
