<?php

namespace App\Models;

use App\Relations\BelongsTo;
use App\Relations\HasMany;
use App\Relations\HasOne;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: companies
 *
 * === Columns: ===
 *
 * @property int $id
 * @property string $encoded_id
 * @property string $name
 * @property string $code_name
 * @property string $bot_token
 * @property int $company_type_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Accessors: ===
 * @property-read string $primary_color
 * @property-read string $secondary_color
 * @property-read string $accent_color
 * @property-read string $background_color
 * @property-read string|null $email
 * @property-read string|null $phone_number
 * @property-read string|null $address
 * @property-read string|null $logo_path
 * @property-read string|null $main_link
 *
 * === Relationships: ===
 * @property-read CompanyType $type
 * @property-read CompanyDesignInfo $design
 * @property-read CompanyDescribingInfo $info
 * @property-read array<Client>|Collection $clients
 * @property-read array<StaffMember>|Collection $staff
 * @property-read array<CompanyAffiliate>|Collection $affiliates
 * @property-read array<Service>|Collection $services
 * @property-read array<JobPosition>|Collection $positions
 */
final class Company extends BaseModel
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function type(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id', 'id');
    }

    public function design(): HasOne
    {
        return $this->hasOne(CompanyDesignInfo::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(CompanyDescribingInfo::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function staff(): HasMany
    {
        return $this->hasMany(StaffMember::class);
    }

    public function affiliates(): HasMany
    {
        return $this->hasMany(CompanyAffiliate::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(JobPosition::class);
    }

    /* === ACCESSORS === */

    public function getPrimaryColorAttribute(): string
    {
        return $this->design->primary_color;
    }

    public function getSecondaryColorAttribute(): string
    {
        return $this->design->secondary_color;
    }

    public function getAccentColorAttribute(): string
    {
        return $this->design->accent_color;
    }

    public function getBackgroundColorAttribute(): string
    {
        return $this->design->background_color;
    }

    public function getEmailAttribute(): string
    {
        return $this->info->email;
    }

    public function getPhoneNumberAttribute(): string
    {
        return $this->info->phone_number;
    }

    public function getAddressAttribute(): string
    {
        return $this->info->address;
    }

    public function getMainLinkAttribute(): string
    {
        return $this->info->main_link;
    }

    public function getLogoPathAttribute(): string
    {
        return $this->info->logo_path;
    }

    /* === MUTATORS === */

    public function setPrimaryColorAttribute(?string $value): void
    {
        $this->design()->update(['primary_color' => $value]);
    }

    public function setSecondaryColorAttribute(?string $value): void
    {
        $this->design()->update(['secondary_color' => $value]);
    }

    public function setAccentColorAttribute(?string $value): void
    {
        $this->design()->update(['accent_color' => $value]);
    }

    public function setBackgroundColorAttribute(?string $value): void
    {
        $this->design()->update(['background_color' => $value]);
    }

    public function setEmailAttribute(?string $value): void
    {
        $this->info()->update(['email' => $value]);
    }

    public function setPhoneNumberAttribute(?string $value): void
    {
        $this->info()->update(['phone_number' => $value]);
    }

    public function setAddressAttribute(?string $value): void
    {
        $this->info()->update(['address' => $value]);
    }

    public function setMainLinkAttribute(?string $value): void
    {
        $this->info()->update(['main_link' => $value]);
    }

    public function setLogoPathAttribute(?string $value): void
    {
        $this->info()->update(['logo_path' => $value]);
    }

    /**
     * @param  array<array<string, int>>  $affiliates
     */
    public function setAffiliatesAttribute(array $affiliates): void
    {
        foreach ($affiliates as $id => $affiliate) {
            $this->affiliates()->updateOrCreate(
                [
                    'id' => $id,
                ],
                [
                    'name' => $affiliate['name'],
                    'address' => $affiliate['address'],
                ]);
        }
    }
}
