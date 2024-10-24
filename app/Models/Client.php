<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: clients
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property string $full_name
 * @property string|null $photo_path
 * @property CarbonInterface|null $date_of_birth
 * @property string|null $description
 * @property string|null $address
 * @property string|null $phone_number
 * @property Gender $gender
 *
 * === Relationships: ===
 * @property-read Company $company
 * @property-read ClientDescribingInfo $info
 * @property-read array<ServiceAssignment>|Collection $assignments
 * @property-read User $user
 */
final class Client extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function company(): Builder
    {
        return $this->belongsTo(Company::class);
    }

    public function info(): Builder
    {
        return $this->hasOne(ClientDescribingInfo::class);
    }

    public function assignments(): Builder
    {
        return $this->hasMany(ServiceAssignment::class);
    }

    public function user(): Builder
    {
        return $this->belongsTo(User::class);
    }

    /* === ACCESSORS === */

    public function getFullNameAttribute(): string
    {
        return $this->surname . ($this->name ? ' ' . $this->name : '') . ($this->patronymic ? ' ' . $this->patronymic : '');
    }

    public function getPhotoPathAttribute(): string
    {
        return $this->info->photo_path;
    }

    public function getDateOfBirthAttribute(): ?CarbonInterface
    {
        return $this->info->date_of_birth;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->info->description;
    }

    public function getAddressAttribute(): string
    {
        return $this->info->address;
    }

    public function getGenderAttribute(): Gender
    {
        return $this->info->gender;
    }

    public function getPhoneNumberAttribute(): ?string
    {
        return $this->user->phone_number;
    }

    /* === MUTATORS === */

    public function setFullNameAttribute(?string $value): void
    {
        $fullNameSeparated = explode(' ', $value ?? '');

        $this->surname = $fullNameSeparated[0];

        $this->name = $fullNameSeparated[1] ?? '';

        $this->patronymic = $fullNameSeparated[2] ?? '';
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

    public function setPhoneNumberAttribute(?string $value): void
    {
        $this->user()->update(['phone_number' => $value]);
    }
}
