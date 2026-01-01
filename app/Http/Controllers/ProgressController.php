<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\SessionExercise;
use App\Models\WorkoutSession;

class ProgressController extends Controller {
    public function index() {
        $user = auth()->user();

        $history = SessionExercise::whereHas('workoutSession', fn($q) => $q->where('user_id', $user->id))
            ->whereNotNull('finished_at')
            ->latest('finished_at')
            ->take(20)
            ->get();

        return view('progress.index', [
            'workoutsCount' => WorkoutSession::where('user_id', $user->id)->count(),
            'exercisesCount' => $history->count(),
            'avgDifficulty' => $history->avg('difficulty') ?? 0,
            'history' => $history,
            'exercises' => Exercise::where('user_id', $user->id)->get(),
        ]);
    }
}
