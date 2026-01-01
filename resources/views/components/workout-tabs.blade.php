@php
    $isWorkouts = request()->routeIs('workouts.*');
    $isExercises = request()->routeIs('exercises.*');
@endphp

<div class="flex bg-zinc-100 rounded-lg p-1">
    <a href="{{ route('workouts.index') }}"
       class="flex-1 text-center py-2 text-sm font-medium rounded-md transition
       {{ $isWorkouts
            ? 'bg-white shadow text-zinc-900'
            : 'text-zinc-500' }}">
        Treinos
    </a>

    <a href="{{ route('exercises.index') }}"
       class="flex-1 text-center py-2 text-sm font-medium rounded-md transition
       {{ $isExercises
            ? 'bg-white shadow text-zinc-900'
            : 'text-zinc-500' }}">
        Exercícios
    </a>
</div>
