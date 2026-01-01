<x-main-layout>
    <div x-data="{
        open: false,
        selectedExercise: {}
    }">
        {{-- HEADER --}}
        <div>
            <h1 class="text-xl font-semibold text-zinc-900">
                {{ $workout->name }}
            </h1>

            <p class="text-sm text-zinc-500">
                {{ getDayLabel($workout->day) }}
            </p>
        </div>

        {{-- OBSERVAÇÕES --}}
        @if ($workout->notes)
            <div class="bg-white rounded-lg shadow-sm p-4 my-2">
                <p class="text-sm text-zinc-600">
                    {{ $workout->notes }}
                </p>
            </div>
        @endif

        {{-- EXERCÍCIOS DO TREINO --}}
        <div class="space-y-3 mt-3">
            <h2 class="text-sm font-medium text-zinc-700">
                Exercícios
            </h2>

            @forelse ($workout->workoutExercises ?? [] as $workoutExercise)
                @php
                    $exercise = $workoutExercise->exercise;
                @endphp

                <div
                    class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center cursor-pointer"
                    @click="
                        open = true;
                        selectedExercise = {
                            id: {{ $workoutExercise->id }},
                            workout_id: {{ $workout->id }},
                            name: '{{ $exercise->name }}',
                            sets: '{{ $workoutExercise->sets }}',
                            reps: '{{ $workoutExercise->reps }}',
                            weight: '{{ $workoutExercise->weight }}',
                            weightType: '{{ $exercise->weight_type }}',
                            muscle: '{{ $exercise->muscleGroup->name ?? '' }}'
                        }
                    "
                >
                    <div>
                        <p class="font-medium text-zinc-800">
                            {{ $exercise->name }}
                        </p>

                        <p class="text-sm text-zinc-500">
                            {{ $workoutExercise->sets }}x{{ $workoutExercise->reps }}
                            @if ($workoutExercise->weight)
                                • {{ $workoutExercise->weight }}{{ $exercise->weight_type }}
                            @endif
                        </p>
                    </div>

                    <span class="text-xs px-2 py-1 rounded bg-zinc-100 text-zinc-600">
                        {{ $exercise->muscleGroup->name ?? '' }}
                    </span>
                </div>
            @empty
                <div class="bg-zinc-50 rounded-lg p-4 text-sm text-zinc-500">
                    Nenhum exercício adicionado a este treino.
                </div>
            @endforelse
        </div>

        {{-- OVERLAY --}}
        <div
            x-show="open"
            x-transition.opacity
            class="fixed inset-0 bg-black/40 z-40"
            @click="open = false"
        ></div>

        {{-- BOTTOM SHEET --}}
        <div
            x-show="open"
            x-transition
            class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl p-5"
        >
            <div class="w-12 h-1 bg-zinc-300 rounded-full mx-auto mb-4"></div>

            <div class="space-y-3">
                <h3 class="text-lg font-semibold text-zinc-800" x-text="selectedExercise.name"></h3>

                <p class="text-sm text-zinc-500">
                    <span x-text="selectedExercise.sets"></span>x
                    <span x-text="selectedExercise.reps"></span>
                    •
                    <span x-text="selectedExercise.weight"></span>
                    <span x-text="selectedExercise.weightType"></span>
                </p>

                <span class="inline-block text-xs px-2 py-1 rounded bg-zinc-100 text-zinc-600"
                      x-text="selectedExercise.muscle"></span>
            </div>

            {{-- AÇÕES --}}
            <div class="mt-6 space-y-2">
                <a :href="`/workouts/${selectedExercise.workout_id}/exercises/${selectedExercise.id}/upgrade`"
                    class="w-full block text-center py-2 rounded-md bg-brand text-white text-sm font-medium"
                >
                    Progredir carga
                </a>

                <form method="POST" :action="`/workouts/${selectedExercise.workout_id}/exercises/${selectedExercise.id}`">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full py-2 rounded-md bg-red-50 text-red-600 text-sm font-medium"
                    >
                        Remover exercício
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-main-layout>
