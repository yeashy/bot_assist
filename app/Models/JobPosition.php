<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: job_positions
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
 * @property-read Company $company
 * @property-read array<Service>|Collection $services
 * @property-read array<Employee>|Collection $employees
 */
final class JobPosition extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function company(): Builder
    {
        return $this->belongsTo(Company::class);
    }

    public function services(): Builder
    {
        return $this->belongsToMany(
            Service::class,
            'job_position_service',
            'job_position_id',
            'service_id',
        );
    }

    public function employees(): Builder
    {
        return $this->hasMany(Employee::class);
    }
}
