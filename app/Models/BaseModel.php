<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Builder hasOne($related, $foreignKey = null, $localKey = null)
 * @method Builder hasMany($related, $foreignKey = null, $localKey = null)
 * @method Builder belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
 * @method Builder belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 */
abstract class BaseModel extends Model {}
