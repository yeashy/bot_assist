<?php

namespace App\Models;

use App\Relations\BelongsTo;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Table: company_describing_infos
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $company_id
 * @property string $main_link
 * @property string $phone_number
 * @property string $logo_path
 * @property string $address
 * @property string $email
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property Company $company
 */
final class CompanyDescribingInfo extends BaseModel
{
    use HasFactory;

    /* === RELATIONS === */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
