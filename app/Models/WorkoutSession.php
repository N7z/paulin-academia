<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $workout_id
 * @property string|null $started_at
 * @property string|null $finished_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SessionExercise> $session_exercises
 * @property-read int|null $session_exercises_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Workout $workout
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereWorkoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession withoutTrashed()
 * @mixin \Eloquent
 */
class WorkoutSession extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function workout(): BelongsTo {
        return $this->belongsTo(Workout::class);
    }

    public function session_exercises(): HasMany {
        return $this->hasMany(SessionExercise::class);
    }
}
