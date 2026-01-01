<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');

    Route::get('/dashboard', [SessionController::class, 'index'])->name('dashboard');
    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');

    Route::get('/sessions/exercises/{sessionExercise}', [SessionController::class, 'show'])->name('sessions.exercises.show');
    Route::get('/sessions/exercises/{sessionExercise}/start', [SessionController::class, 'start'])->name('sessions.exercises.start');
    Route::get('/sessions/exercises/{sessionExercise}/skip', [SessionController::class, 'skip'])->name('sessions.exercises.skip');
    Route::post('/sessions/exercises/{sessionExercise}/finish', [SessionController::class, 'finish'])->name('sessions.exercises.finish');
    Route::get('/sessions/exercises/{sessionExercise}/mark_as_finish', [SessionController::class, 'mark_as_finish'])->name('sessions.exercises.mark_as_finish');

    Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
    Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
    Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
    Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');

    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/workouts/create', [WorkoutController::class, 'create'])->name('workouts.create');
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{workout}', [WorkoutController::class, 'show'])->name('workouts.show');

    Route::prefix('/workouts/{workout}/exercises')->group(function () {
        Route::get('/create', [WorkoutExerciseController::class, 'create'])
            ->name('workouts.exercises.create');

        Route::post('/', [WorkoutExerciseController::class, 'store'])
            ->name('workouts.exercises.store');

        Route::delete('/{exercise}', [WorkoutExerciseController::class, 'destroy'])
            ->name('workouts.exercises.destroy');

        Route::get('/{exercise}/upgrade', [WorkoutExerciseController::class, 'upgrade'])
            ->name('workouts.exercises.upgrade');
    });
});

require __DIR__.'/auth.php';
