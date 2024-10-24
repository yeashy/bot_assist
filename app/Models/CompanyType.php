<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Table: company_types
 *
 * === Columns: ===
 *
 * @property int $id
 * @property string $code_name
 * @property string $name
 *
 * === Relationships: ===
 * @property-read array<Company>|Collection $companies
 */
final class CompanyType extends BaseModel
{
    use CrudTrait;

    public $timestamps = false;

    protected $guarded = [];

    /* === RELATIONS === */

    public function companies(): Builder
    {
        return $this->hasMany(Company::class, 'company_type_id', 'id');
    }
}
