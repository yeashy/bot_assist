<?php

namespace App\Models;

use App\Relations\BelongsTo;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: client_describing_infos
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $client_id
 * @property int $gender_id
 * @property string $photo_path
 * @property CarbonInterface|null $date_of_birth
 * @property string $address
 * @property string $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property-read Client $client
 * @property-read Gender $gender
 */
final class ClientDescribingInfo extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
