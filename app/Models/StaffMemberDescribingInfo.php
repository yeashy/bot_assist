<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffMemberDescribingInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function member(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }
}
