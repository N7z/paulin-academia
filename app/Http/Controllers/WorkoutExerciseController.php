<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
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
            'exercises' => ['required', 'array', 'min:1'],
        ]);

        $nextOrder = WorkoutExercise::where('workout_id', $workout->id)->max('order') ?? 0;

        foreach ($data['exercises'] as $exercise) {
            WorkoutExercise::create([
                'workout_id'  => $workout->id,
                'exercise_id' => $exercise['exercise_id'],
                'order'       => ++$nextOrder,
                'sets'        => $exercise['sets'],
                'reps'        => $exercise['reps'],
                'weight'      => $exercise['weight'],
            ]);
        }

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Exercício(s) adicionado(s) ao treino');
    }

    /*
     * Progredir carga
     */
    public function upgrade(Workout $workout, WorkoutExercise $exercise) {
        $exercise->increment('weight');
        return back()
            ->with('success', "\"{$exercise->exercise->name}\" progredido para {$exercise->weight}{$exercise->exercise->weight_type}");
    }

    public function destroy(Workout $workout, WorkoutExercise $exercise) {
        abort_if($workout->user_id !== auth()->id(), 403);

        $exercise->delete();
        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Exercício removido do treino');
    }
}
