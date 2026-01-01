<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $day
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutExercise> $workoutExercises
 * @property-read int|null $workout_exercises_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workout withoutTrashed()
 * @mixin \Eloquent
 */
class Workout extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function workoutExercises(): HasMany {
        return $this->hasMany(WorkoutExercise::class)->orderBy('order');
    }
}
