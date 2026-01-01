<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exercise> $exercises
 * @property-read int|null $exercises_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MuscleGroup withoutTrashed()
 * @mixin \Eloquent
 */
class MuscleGroup extends Model
{
    use SoftDeletes;

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
