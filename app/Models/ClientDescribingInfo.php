<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientDescribingInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
