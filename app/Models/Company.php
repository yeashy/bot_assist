<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

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

    // ACCESSORS

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

    public function getEmailAttribute()
    {
        return $this->info->email;
    }

    public function getPhoneNumberAttribute()
    {
        return $this->info->phone_number;
    }

    public function getAddressAttribute()
    {
        return $this->info->address;
    }

    public function getMainLinkAttribute()
    {
        return $this->info->main_link;
    }

    public function getLogoPathAttribute()
    {
        return $this->info->logo_path;
    }

    // MUTATORS

    public function setPrimaryColorAttribute(?string $value): string
    {
        return $this->design()->update(['primary_color' => $value]);
    }

    public function setSecondaryColorAttribute(?string $value): string
    {
        return $this->design()->update(['secondary_color' => $value]);
    }

    public function setAccentColorAttribute(?string $value): string
    {
        return $this->design()->update(['accent_color' => $value]);
    }

    public function setBackgroundColorAttribute(?string $value): string
    {
        return $this->design()->update(['background_color' => $value]);
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

    public function setAffiliatesAttribute(array $affiliates): void
    {
        foreach ($affiliates as $id => $affiliate) {
            $this->affiliates()->updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'name' => $affiliate['name'],
                    'address' => $affiliate['address']
                ]);
        }
    }
}
