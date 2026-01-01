<?php

use App\Models\SessionExercise;
use App\Models\WorkoutSession;
use Illuminate\Support\Collection;

function addActionRoute(): string
{
    return match (true) {
        request()->routeIs('workouts.show') =>
            route('workouts.exercises.create', request()->route('workout')),

        request()->routeIs('workouts.*') =>
            route('workouts.create'),

        request()->routeIs('exercises.*') =>
            route('exercises.create'),

        default =>
            route('workouts.create'),
    };
}

function getDayLabel($day): string {
    return [
        1 => 'Segunda',
        2 => 'Terça',
        3 => 'Quarta',
        4 => 'Quinta',
        5 => 'Sexta',
        6 => 'Sábado',
        7 => 'Domingo',
    ][$day] ?? '';
}

function getWorkoutSession(): WorkoutSession|null {
    return WorkoutSession::where('user_id', auth()->id())
        ->where('finished_at', null)
        ->latest()
        ->first();
}

function calculateBurntCalories(Collection $exercises): int {
    return 0;
}

function anyExerciseStarted(WorkoutSession $session, SessionExercise $currentExercise): ?SessionExercise {
    return SessionExercise::where('workout_session_id', $session->id)
        ->whereNot('id', $currentExercise->id)
        ->whereNotNull('started_at')
        ->whereNotNull('ended_at')
        ->where('completed', false)
        ->first();
}

function hasTrainedToday(): bool {
    return WorkoutSession::where('user_id', auth()->id())
        ->whereToday('started_at')
        ->get()->count() > 0;
}
