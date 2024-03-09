<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use CrudTrait;
    use HasFactory;

    // RELATIONS

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // ACCESSORS

    public function getFullNameAttribute(): string
    {
        return $this->surname . ($this->name ? ' ' . $this->name : '') . ($this->patronymic ? ' ' . $this->patronymic : '');
    }

    // MUTATORS

    public function setFullNameAttribute(string $value): void
    {
        $fullnameSeparated = explode(' ', $value);

        $this->surname = $fullnameSeparated[0];

        $this->name = $fullnameSeparated[1] ?? null;

        $this->patronymic = $fullnameSeparated[2] ?? null;
    }
}
