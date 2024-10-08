<?php

namespace App\Models;

use App\Helpers\PhoneNumberHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'external_id'
    ];

    protected $appends = [
        'phone_number_pretty'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* === RELATIONS === */

    public function clientEntities(): HasMany
    {
        return $this->hasMany(Client::class, 'user_id', 'id');
    }

    public function client(int $companyId): Model|HasMany|Client|null
    {
        return $this->clientEntities()->firstWhere('company_id', $companyId);
    }

    /* === ACCESSORS & MUTATORS === */

    public function getPhoneNumberPrettyAttribute(): ?string
    {
        if (!empty($this->phone_number)) {
            return PhoneNumberHelper::getPrettyFromStandard($this->phone_number);
        }

        return null;
    }
}
