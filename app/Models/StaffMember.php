<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: staff_members
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property-read string $full_name
 * @property-read string $short_name
 * @property-read string|null $phone_number
 * @property-read string|null $photo_path
 * @property-read CarbonInterface|null $date_of_birth
 * @property-read string|null $description
 *
 * === Relationships: ===
 * @property-read Company $company
 * @property-read StaffMemberDescribingInfo $info
 * @property-read array<JobPosition>|Collection $positions
 * @property-read Gender $gender
 */
final class StaffMember extends BaseModel
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
        return $this->hasOne(StaffMemberDescribingInfo::class);
    }

    public function positions(): Builder
    {
        return $this->hasMany(Employee::class);
    }

    /* === ACCESSORS === */

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

    public function getPhoneNumberAttribute(): ?string
    {
        return $this->info->phone_number;
    }

    public function getPhotoPathAttribute(): ?string
    {
        return $this->info->photo_path;
    }

    public function getDateOfBirthAttribute(): CarbonInterface|string|null
    {
        return $this->info->date_of_birth;
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->info->description;
    }

    public function getGenderAttribute(): ?Gender
    {
        return $this->info->gender;
    }

    /* === MUTATORS === */

    public function setFullNameAttribute(string $value): void
    {
        $fullNameSeparated = explode(' ', $value);

        $this->surname = $fullNameSeparated[0];

        $this->name = $fullNameSeparated[1] ?? '';

        $this->patronymic = $fullNameSeparated[2] ?? '';
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
