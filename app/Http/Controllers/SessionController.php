<?php

namespace App\Http\Controllers;

use App\Models\SessionExercise;
use App\Models\WorkoutExercise;
use App\Models\WorkoutSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller {
    public function index() {
        $session = getWorkoutSession();

        if ($session) {
            $timeSpent = Carbon::parse($session->started_at)->longAbsoluteDiffForHumans();

            $completedExercises = $session->session_exercises()->where('completed', true)->get();
            $pendingExercises = $session->session_exercises()->where('completed', false)->get();

            $exercisesPending = $session->session_exercises->count();
            $exercisesDone = $completedExercises?->count();

            $caloriesBurnt = calculateBurntCalories($completedExercises);
        }

        return view('dashboard', [
            'session' => $session,
            'timeSpent' => $timeSpent ?? null,
            'caloriesBurnt' => $caloriesBurnt ?? null,
            'exercisesPending' => $exercisesPending ?? null,
            'exercisesDone' => $exercisesDone ?? null,
            'pendingExercises' => $pendingExercises ?? null,
        ]);
    }

    public function show(SessionExercise $sessionExercise) {
        return view('workouts.sessions.show', [
            'sessionExercise' => $sessionExercise,
        ]);
    }

    public function create() {
        $workouts = auth()
            ->user()
            ->workouts()
            ->orderBy('day')
            ->get();

        return view('workouts.sessions.create', compact('workouts'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'workout_id' => ['required', 'exists:workouts,id'],
            'started_at' => ['required', 'date'],
        ]);

        $session = WorkoutSession::create([
            'user_id' => auth()->id(),
            'workout_id' => $data['workout_id'],
            'started_at' => $data['started_at']
        ]);

        $session->workout->workoutExercises->each(function (WorkoutExercise $workoutExercise) use ($session) {
            SessionExercise::create([
                'workout_session_id' => $session->id,
                'workout_exercise_id' => $workoutExercise->id
            ]);
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Treino iniciado com sucesso');
    }

    public function start(SessionExercise $sessionExercise) {
        if ($exercise = anyExerciseStarted($sessionExercise->workoutSession, $sessionExercise))
            return back()
                ->with('error', "Outro exercício em andamento \"{$exercise->workoutExercise->exercise->name}\"");

        if ($sessionExercise->completed || $sessionExercise->ended_at)
            return back()
                ->with('error', 'Exercício já foi completo/finalizado');

        if ($sessionExercise->started_at)
            return redirect()
                ->route('sessions.exercises.show', $sessionExercise)
                ->with('success', 'Retomando exercício em andamento');

        $sessionExercise->update([
            'started_at' => now()
        ]);

        return redirect()
            ->route('sessions.exercises.show', $sessionExercise)
            ->with('success', 'Exercício iniciado com sucesso');
    }

    public function skip(SessionExercise $sessionExercise) {
        $sessionExercise->delete();

        $session = $sessionExercise->workoutSession;
        $pendingExercises = $session->session_exercises()->where('completed', false)->count();

        if ($pendingExercises == 0) {
            $session->update([
                'finished_at' => now(),
            ]);

            $timeSpent = Carbon::parse($session->started_at)->longAbsoluteDiffForHumans();

            return redirect()
                ->route('dashboard')
                ->with('success', "Treino finalizado com sucesso, duração total: $timeSpent");
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Exercício pulado com sucesso');
    }

    public function mark_as_finish(SessionExercise $sessionExercise) {
        $sessionExercise->update([
            'completed' => true,
            'difficulty' => 1,
            'performed_sets' => $sessionExercise->workoutExercise->sets,
            'performed_reps' => $sessionExercise->workoutExercise->reps,
            'performed_weight' => $sessionExercise->workoutExercise->weight,
            'notes' => 'Marcado como concluído',
            'ended_at' => now(),
        ]);

        return $this->checkWorkoutSession($sessionExercise);
    }

    public function finish(Request $request, SessionExercise $sessionExercise) {
        $data = $request->validate([
            'performed_sets' => ['required', 'integer'],
            'performed_reps' => ['required', 'integer'],
            'performed_weight' => ['required', 'numeric'],
            'difficulty' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        $sessionExercise->update([
            'completed' => true,
            'difficulty' => $data['difficulty'],
            'performed_sets' => $data['performed_sets'],
            'performed_reps' => $data['performed_reps'],
            'performed_weight' => $data['performed_weight'],
            'notes' => $data['notes'],
            'ended_at' => now(),
        ]);

        return $this->checkWorkoutSession($sessionExercise);
    }

    /**
     * @param SessionExercise $sessionExercise
     * @return \Illuminate\Http\RedirectResponse
     */
    private function checkWorkoutSession(SessionExercise $sessionExercise): \Illuminate\Http\RedirectResponse {
        $session = $sessionExercise->workoutSession;
        $pendingExercises = $session->session_exercises()->where('completed', false)->count();

        if ($pendingExercises == 0) {
            $session->update([
                'finished_at' => now(),
            ]);

            $timeSpent = Carbon::parse($session->started_at)->longAbsoluteDiffForHumans();

            return redirect()
                ->route('dashboard')
                ->with('success', "Treino finalizado com sucesso, duração total: $timeSpent");
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Exercício finalizado com sucesso');
    }
}
