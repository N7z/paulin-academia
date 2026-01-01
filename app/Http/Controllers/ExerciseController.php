<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $muscleGroups = MuscleGroup::with('exercises')
            ->orderBy('name')
            ->get();

        return view('exercises.index', compact('muscleGroups'));
    }

    public function create()
    {
        $muscleGroups = MuscleGroup::orderBy('name')->get();

        return view('exercises.create', compact('muscleGroups'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'muscle_group_id' => ['required', 'exists:muscle_groups,id'],
            'name' => ['required', 'string', 'max:255'],
            'sets' => ['nullable', 'integer'],
            'reps' => ['nullable', 'integer'],
            'weight' => ['nullable', 'numeric'],
            'weight_type' => ['required', 'in:kg,lb,unit'],
        ]);

        $data['user_id'] = auth()->id();

        Exercise::create($data);

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Exercício criado com sucesso');
    }
}
