<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $workout_id
 * @property int $exercise_id
 * @property int $order
 * @property int|null $sets
 * @property int|null $reps
 * @property float|null $weight
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exercise $exercise
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SessionExercise> $sessionExercises
 * @property-read int|null $session_exercises_count
 * @property-read \App\Models\Workout $workout
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereWorkoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise withoutTrashed()
 * @mixin \Eloquent
 */
class WorkoutExercise extends Model {
    use SoftDeletes;

    public function workout(): BelongsTo {
        return $this->belongsTo(Workout::class);
    }

    public function exercise(): BelongsTo {
        return $this->belongsTo(Exercise::class);
    }

    public function sessionExercises(): HasMany {
        return $this->hasMany(SessionExercise::class);
    }
}
