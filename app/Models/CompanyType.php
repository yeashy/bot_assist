<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyType extends Model
{
    use CrudTrait;
    public $timestamps = false;

    protected $guarded = [];

    // RELATIONS

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'company_type_id', 'id');
    }
}
