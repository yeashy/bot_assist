<?php

namespace App\Models;

use App\Relations\BelongsTo;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: staff_member_describing_infos
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $staff_member_id
 * @property int|null $gender_id
 * @property string|null $photo_path
 * @property string|null $phone_number
 * @property CarbonInterface|null $date_of_birth
 * @property string|null $description
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 *
 * === Relationships: ===
 * @property-read StaffMember $member
 * @property-read Gender|null $gender
 */
final class StaffMemberDescribingInfo extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function member(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
