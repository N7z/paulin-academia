<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $workout_session_id
 * @property int $workout_exercise_id
 * @property int $difficulty
 * @property int|null $performed_sets
 * @property int|null $performed_reps
 * @property float|null $performed_weight
 * @property string|null $notes
 * @property int $completed
 * @property string|null $started_at
 * @property string|null $ended_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkoutExercise $workoutExercise
 * @property-read \App\Models\WorkoutSession $workoutSession
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise wherePerformedReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise wherePerformedSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise wherePerformedWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereWorkoutExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise whereWorkoutSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionExercise withoutTrashed()
 * @mixin \Eloquent
 */
class SessionExercise extends Model
{
    use SoftDeletes;

    public function workoutSession(): BelongsTo {
        return $this->belongsTo(WorkoutSession::class);
    }

    public function workoutExercise(): BelongsTo {
        return $this->belongsTo(WorkoutExercise::class);
    }
}
