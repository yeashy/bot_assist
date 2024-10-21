<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jenssegers\Date\Date;

class EmployeeWorkingPeriod extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'is_free'
    ];

    // RELATIONS

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignment(): HasOne
    {
        return $this->hasOne(ServiceAssignment::class);
    }

    // ACCESSORS

    public function getIsFreeAttribute(): bool
    {
        return !$this->assignment;
    }

    public function getDatetimeAttribute(): string
    {
        return Date::parse($this->date . ' ' . $this->start_time)
            ->format('d F, H:i');
    }
}
