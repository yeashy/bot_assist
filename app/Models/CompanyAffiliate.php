<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyAffiliate extends Model
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

    /* === ATTRIBUTES === */

    public function getCoordinatesAttribute(): string
    {
        return $this->latitude . ',' . $this->longitude;
    }

    public function setCoordinatesAttribute(string $coordinates): void
    {
        [$this->latitude, $this->longitude] = explode(',', $coordinates);
    }
}
