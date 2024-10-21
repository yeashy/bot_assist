<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffMember extends Model
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
        return $this->hasOne(StaffMemberDescribingInfo::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

//    public function gender()
//    {
//        return $this->hasOneThrough(Gender::class, StaffMemberDescribingInfo::class);
//    }

    // ACCESSORS

    public function getFullNameAttribute(): string
    {
        return $this->surname . ($this->name ? ' ' . $this->name : '') . ($this->patronymic ? ' ' . $this->patronymic : '');
    }

    public function getShortNameAttribute(): string
    {
        return
            $this->surname
            . ($this->name ? ' ' . mb_substr($this->name, 0, 1) . '. ' : '')
            . ($this->patronymic ? ' ' . mb_substr($this->patronymic, 0, 1) . '. ' : '');
    }

    public function getPhoneNumberAttribute()
    {
        return $this->info->phone_number;
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

    public function getGenderAttribute()
    {
        return $this->info->gender;
    }

    // MUTATORS

    public function setFullNameAttribute(string $value): void
    {
        $fullnameSeparated = explode(' ', $value);

        $this->surname = $fullnameSeparated[0];

        $this->name = $fullnameSeparated[1] ?? null;

        $this->patronymic = $fullnameSeparated[2] ?? null;
    }

    public function setPhoneNumberAttribute(?string $value): void
    {
        $this->info()->update(['phone_number' => $value]);
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

    public function setGenderAttribute(?int $value): void
    {
        $this->info()->update(['gender_id' => $value]);
    }
}
