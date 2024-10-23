<?php

namespace App\Models;

use App\Helpers\PhoneNumberHelper;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Table: users
 *
 * === Columns: ===
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property int|string|null $external_id
 * @property string|null $phone_number
 * @property string|null $remember_token
 *
 * === Accessors: ===
 * @property string|null $phone_number_pretty
 *
 * === Relationships: ===
 * @property-read Client[]|Collection $clients
 */
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
        'external_id',
    ];

    protected $appends = [
        'phone_number_pretty',
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

    public function clients(): HasMany|Builder
    {
        return $this->hasMany(Client::class, 'user_id', 'id');
    }

    public function client(int $companyId): Model|HasMany|Client|null
    {
        return $this->clients()->firstWhere('company_id', $companyId);
    }

    /* === ACCESSORS & MUTATORS === */

    public function getPhoneNumberPrettyAttribute(): ?string
    {
        if (! empty($this->phone_number)) {
            return PhoneNumberHelper::getPrettyFromStandard($this->phone_number);
        }

        return null;
    }
}
