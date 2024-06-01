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

    public function getBackgroundColorAttribute(): string
    {
        return $this->design->background_color;
    }

    public function getTextColorAttribute(): string
    {
        return $this->design->text_color;
    }

    public function getBorderColorAttribute(): string
    {
        return $this->design->border_color;
    }

    public function getBlockBackgroundColorAttribute(): string
    {
        return $this->design->block_background_color;
    }

    public function getButtonBackgroundColorAttribute(): string
    {
        return $this->design->button_background_color;
    }

    public function getMainBackgroundColorAttribute(): string
    {
        return $this->design->main_background_color;
    }

    public function getAdditionalBackgroundColorAttribute(): string
    {
        return $this->design->additional_background_color;
    }

    public function getButtonTextColorAttribute(): string
    {
        return $this->design->button_text_color;
    }

    public function getMainTextColorAttribute(): string
    {
        return $this->design->main_text_color;
    }

    public function getAdditionalTextColorAttribute(): string
    {
        return $this->design->additional_text_color;
    }

    public function getFontAttribute()
    {
        return $this->design->font;
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

    public function setBackgroundColorAttribute(string $value): string
    {
        return $this->design()->update(['background_color' => $value]);
    }

    public function setTextColorAttribute(string $value): string
    {
        return $this->design()->update(['text_color' => $value]);
    }

    public function setBorderColorAttribute(string $value): string
    {
        return $this->design()->update(['border_color' => $value]);
    }

    public function setBlockBackgroundColorAttribute(string $value): string
    {
        return $this->design()->update(['block_background_color' => $value]);
    }

    public function setButtonBackgroundColorAttribute(string $value): string
    {
        return $this->design()->update(['button_background_color' => $value]);
    }

    public function setMainBackgroundColorAttribute(string $value): string
    {
        return $this->design()->update(['main_background_color' => $value]);
    }

    public function setAdditionalBackgroundColorAttribute(string $value): string
    {
        return $this->design()->update(['additional_background_color' => $value]);
    }

    public function setButtonTextColorAttribute(string $value): string
    {
        return $this->design()->update(['button_text_color' => $value]);
    }

    public function setMainTextColorAttribute(string $value): string
    {
        return $this->design()->update(['main_text_color' => $value]);
    }

    public function setAdditionalTextColorAttribute(string $value): string
    {
        return $this->design()->update(['additional_text_color' => $value]);
    }

    public function setFontAttribute(int $value): void
    {
        $this->design()->update(['font_id' => $value]);
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
