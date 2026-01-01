<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $muscle_group_id
 * @property string $name
 * @property int|null $sets
 * @property int|null $reps
 * @property float|null $weight
 * @property string|null $weight_type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MuscleGroup $muscleGroup
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Workout> $workouts
 * @property-read int|null $workouts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereMuscleGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereWeightType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise withoutTrashed()
 * @mixin \Eloquent
 */
class Exercise extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class);
    }

    public function workouts(): BelongsToMany
    {
        return $this->belongsToMany(Workout::class, 'workout_exercises')
            ->withPivot(['order'])
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
    }
}
