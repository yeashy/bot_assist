<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Table: service_assignments
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $client_id
 * @property int $employee_working_period_id
 * @property int $service_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property-read Service $service
 * @property-read Client $client
 * @property-read EmployeeWorkingPeriod $period
 */
final class ServiceAssignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(EmployeeWorkingPeriod::class, 'employee_working_period_id');
    }
}
