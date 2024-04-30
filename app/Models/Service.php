<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

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
