<?php

namespace App\Models;

use App\Relations\BelongsTo;
use App\Relations\BelongsToMany;
use App\Relations\HasMany;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: services
 *
 * === Columns: ===
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property-read array<ServiceAssignment>|Collection $assignments
 * @property-read Company $company
 * @property-read array<JobPosition>|Collection $positions
 */
final class Service extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function assignments(): HasMany
    {
        return $this->hasMany(ServiceAssignment::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(JobPosition::class, 'job_position_service');
    }
}
