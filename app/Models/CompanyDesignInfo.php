<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyDesignInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
