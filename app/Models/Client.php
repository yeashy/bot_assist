<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(ClientDescribingInfo::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(ServiceAssignment::class);
    }

    // ACCESSORS

    public function getFullNameAttribute(): string
    {
        return $this->surname . ($this->name ? ' ' . $this->name : '') . ($this->patronymic ? ' ' . $this->patronymic : '');
    }

    public function getPhotoPathAttribute()
    {
        return $this->info->photo_path;
    }

    public function getDateOfBirthAttribute()
    {
        return $this->info->date_of_birth;
    }

    public function getDescriptionAttribute()
    {
        return $this->info->description;
    }

    public function getAddressAttribute()
    {
        return $this->info->address;
    }

    public function getGenderAttribute()
    {
        return $this->info->gender;
    }

    // MUTATORS

    public function setFullNameAttribute(?string $value): void
    {
        $fullnameSeparated = explode(' ', $value);

        $this->surname = $fullnameSeparated[0];

        $this->name = $fullnameSeparated[1] ?? null;

        $this->patronymic = $fullnameSeparated[2] ?? null;
    }

    public function setPhotoPathAttribute(?string $value): void
    {
        $this->info()->update(['photo_path' => $value]);
    }

    public function setDateOfBirthAttribute(?string $value): void
    {
        $this->info()->update(['date_of_birth' => $value]);
    }

    public function setDescriptionAttribute(?string $value): void
    {
        $this->info()->update(['description' => $value]);
    }

    public function setAddressAttribute(?string $value): void
    {
        $this->info()->update(['address' => $value]);
    }

    public function setGenderAttribute(?int $value): void
    {
        $this->info()->update(['gender_id' => $value]);
    }
}
