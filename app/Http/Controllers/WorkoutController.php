<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index() {
        $workouts = Workout::all();
        return view('workouts.index', compact('workouts'));
    }

    public function show(Workout $workout) {
        abort_if($workout->user_id !== auth()->id(), 403);

        return view('workouts.show', compact('workout'));
    }

    public function create() {
        return view('workouts.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'integer', 'between:1,7'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['user_id'] = auth()->id();

        Workout::create($data);

        return redirect()
            ->route('workouts.index')
            ->with('success', 'Treino criado com sucesso');
    }

}
