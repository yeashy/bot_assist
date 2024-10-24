<?php

namespace App\Models;

use App\Relations\BelongsTo;
use App\Relations\HasMany;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: company_affiliates
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string|null $address
 * @property string|float|null $latitude
 * @property string|float|null $longitude
 * @property string|null $phone_number
 * @property bool $is_main
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property-read string $coordinates
 *
 * === Relationships: ===
 * @property-read Company $company
 * @property-read array<Employee>|Collection $employees
 */
final class CompanyAffiliate extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /* === ACCESSORS === */

    public function getCoordinatesAttribute(): string
    {
        return $this->latitude . ',' . $this->longitude;
    }

    /* === MUTATORS === */

    public function setCoordinatesAttribute(string $coordinates): void
    {
        [$this->latitude, $this->longitude] = explode(',', $coordinates);
    }
}
