<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Table: client_describing_infos
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $client_id
 * @property int $gender_id
 * @property string $photo_path
 * @property CarbonInterface $date_of_birth
 * @property string $address
 * @property string $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property-read Client $client
 * @property-read Gender $gender
 */
class ClientDescribingInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // RELATIONS

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
