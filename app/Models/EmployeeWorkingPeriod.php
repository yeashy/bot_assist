<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: employee_working_periods
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $employee_id
 * @property CarbonInterface $date
 * @property CarbonInterface $start_time
 * @property CarbonInterface $end_time
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property-read bool $if_free
 * @property-read string $date_time
 *
 * === Relationships: ===
 * @property-read Employee $employee
 * @property-read ServiceAssignment|null $assignment
 */
final class EmployeeWorkingPeriod extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    /** @var array<string> */
    protected $appends = [
        'is_free',
    ];

    /* RELATIONS */

    public function employee(): Builder
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignment(): Builder
    {
        return $this->hasOne(ServiceAssignment::class);
    }

    /* === ACCESSORS === */

    public function getIsFreeAttribute(): bool
    {
        return ! $this->assignment;
    }

    public function getDatetimeAttribute(): string
    {
        return $this->date
            ->addHours($this->start_time->hour)
            ->addMinutes($this->start_time->minute)
            ->addSeconds($this->end_time->second)
            ->format('d F, H:i');
    }
}
