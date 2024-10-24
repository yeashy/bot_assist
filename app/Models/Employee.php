<?php

namespace App\Models;

use App\Relations\BelongsTo;
use App\Relations\HasMany;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: employees
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $staff_member_id
 * @property int $job_position_id
 * @property int $company_affiliate_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property-read string $full_name
 *
 * === Relationships: ===
 * @property-read StaffMember $person
 * @property-read JobPosition $position
 * @property-read CompanyAffiliate $affiliate
 * @property-read array<EmployeeWorkingPeriod>|Collection $periods
 */
final class Employee extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    /* === RELATIONS === */

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

    /* === ACCESSORS === */

    public function getFullNameAttribute(): string
    {
        return $this->person->full_name;
    }
}
