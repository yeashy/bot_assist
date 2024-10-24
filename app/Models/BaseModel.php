<?php

namespace App\Models;

use App\Relations\BelongsTo;
use App\Relations\BelongsToMany;
use App\Relations\HasMany;
use App\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method HasOne hasOne($related, $foreignKey = null, $localKey = null)
 * @method HasMany hasMany($related, $foreignKey = null, $localKey = null)
 * @method BelongsTo belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
 * @method BelongsToMany belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 */
abstract class BaseModel extends Model
{
    protected function newHasOne(Builder $query, Model $parent, $foreignKey, $localKey): HasOne
    {
        return new HasOne($query, $parent, $foreignKey, $localKey);
    }

    protected function newHasMany(Builder $query, Model $parent, $foreignKey, $localKey): HasMany
    {
        return new HasMany($query, $parent, $foreignKey, $localKey);
    }

    protected function newBelongsTo(Builder $query, Model $child, $foreignKey, $ownerKey, $relation): BelongsTo
    {
        return new BelongsTo($query, $child, $foreignKey, $ownerKey, $relation);
    }

    protected function newBelongsToMany(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName = null): BelongsToMany
    {
        return new BelongsToMany($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }
}
