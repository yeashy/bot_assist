<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function type(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id', 'id');
    }

    public function design(): HasOne
    {
        return $this->hasOne(CompanyDesignInfo::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(CompanyDescribingInfo::class);
    }

    // ACCESSORS
    public function typeName()
    {
        return Attribute::make(
            get: fn () => $this->type->name,
            set: fn (string $value) => $this->type->update(['name' => $value])
        );
    }

    public function primaryColor()
    {
        return Attribute::make(
            get: fn () => $this->design->primary_color,
            set: fn (string $value) => $this->design->update(['primary_color' => $value])
        );
    }
}
