<?php

namespace App\Http\Controllers;

use App\Models\MuscleGroup;
use App\Models\Workout;
use App\Models\WorkoutExercise;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    public function create(Workout $workout)
    {
        abort_if($workout->user_id !== auth()->id(), 403);

        $muscleGroups = MuscleGroup::with('exercises')->get();

        return view('workouts.exercises.create', [
            'workout' => $workout,
            'muscleGroups' => $muscleGroups,
        ]);
    }

    public function store(Request $request, Workout $workout)
    {
        abort_if($workout->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
            'sets' => ['required', 'integer'],
            'reps' => ['required', 'integer'],
            'weight' => ['required', 'numeric'],
        ]);

        $nextOrder = WorkoutExercise::where('workout_id', $workout->id)->max('order') ?? 0;

        WorkoutExercise::create([
            'workout_id'  => $workout->id,
            'exercise_id' => $data['exercise_id'],
            'order'       => $nextOrder + 1,
            'sets'        => $data['sets'],
            'reps'        => $data['reps'],
            'weight'      => $data['weight'],
        ]);

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Exercício adicionado ao treino');
    }

    public function destroy(Workout $workout, WorkoutExercise $exercise) {
        abort_if($workout->user_id !== auth()->id(), 403);

        $exercise->delete();
        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Exercício removido do treino');
    }
}
