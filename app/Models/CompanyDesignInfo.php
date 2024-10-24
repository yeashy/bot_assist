<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Table: company_design_infos
 *
 * === Columns: ===
 *
 * @property int $id
 * @property int $company_id
 * @property string $primary_color
 * @property string $secondary_color
 * @property string $accent_color
 * @property string $background_color
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * === Relationships: ===
 * @property-read Company $company
 */
final class CompanyDesignInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* === RELATIONS === */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
