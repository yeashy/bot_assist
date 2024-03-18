<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmployeeWorkingPeriod extends Model
{
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignment(): HasOne
    {
        return $this->hasOne(ServiceAssignment::class);
    }
}
