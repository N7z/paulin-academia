<x-main-layout>
    @if ($session)

        <div
            x-data="{
                open: false,
                exercise: {}
            }"
        >

            {{-- TÍTULO --}}
            <div>
                <h1 class="text-xl font-semibold text-zinc-900">
                    Hoje • {{ $session->workout->name }}
                </h1>
                <p class="text-sm text-zinc-500">
                    {{ now()->format('d/m/Y') }}
                </p>
            </div>

            {{-- RESUMO --}}
            <div class="grid grid-cols-3 gap-3 mt-3">
                <div class="p-3 rounded-lg bg-white shadow-sm text-center">
                    <p class="text-xs text-zinc-500">Tempo</p>
                    <p class="font-semibold">{{ $timeSpent }}</p>
                </div>

                <div class="p-3 rounded-lg bg-white shadow-sm text-center">
                    <p class="text-xs text-zinc-500">Exercícios</p>
                    <p class="font-semibold">{{ $exercisesDone }} / {{ $exercisesPending }}</p>
                </div>

                <div class="p-3 rounded-lg bg-white shadow-sm text-center">
                    <p class="text-xs text-zinc-500">Calorias</p>
                    <p class="font-semibold">{{ $caloriesBurnt }} kcal</p>
                </div>
            </div>

            {{-- EXERCÍCIOS --}}
            <div class="space-y-3 mt-4">
                <h2 class="text-sm font-semibold text-zinc-700">
                    Exercícios
                </h2>

                @foreach($pendingExercises as $sessionExercise)
                    @php
                        $workoutExercise = $sessionExercise->workoutExercise;
                        $exercise = $workoutExercise->exercise;
                    @endphp

                    <div
                        class="p-4 rounded-lg bg-white shadow-sm cursor-pointer active:scale-[0.98] transition"
                        @click="
                            open = true;
                            exercise = {
                                id: {{ $sessionExercise->id }},
                                name: '{{ $exercise->name }}',
                                muscle: '{{ $exercise->muscleGroup->name ?? '' }}',
                                sets: '{{ $workoutExercise->sets }}',
                                reps: '{{ $workoutExercise->reps }}',
                                weight: '{{ $workoutExercise->weight }}',
                                weightType: '{{ $exercise->weight_type }}'
                            }
                        "
                    >
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
                @endforeach
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

                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-zinc-900" x-text="exercise.name"></h3>

                    <span
                        class="inline-block text-xs px-2 py-1 rounded bg-zinc-100 text-zinc-600"
                        x-text="exercise.muscle"
                    ></span>

                    <p class="text-sm text-zinc-500">
                        <span x-text="exercise.sets"></span>x<span x-text="exercise.reps"></span>
                        • <span x-text="exercise.weight"></span><span x-text="exercise.weightType"></span>
                    </p>
                </div>

                {{-- AÇÕES --}}
                <div class="mt-6 space-y-2">

                    <a
                        :href="`{{ url('/sessions/exercises') }}/${exercise.id}/start`"
                        class="block w-full text-center py-2 rounded-lg bg-brand text-white font-medium"
                    >
                        Iniciar exercício
                    </a>

                    <a
                        :href="`{{ url('/sessions/exercises') }}/${exercise.id}/skip`"
                        class="block w-full text-center py-2 rounded-lg bg-zinc-100 text-zinc-700 font-medium"
                    >
                        Pular exercício
                    </a>

                    <a
                        :href="`{{ url('/sessions/exercises') }}/${exercise.id}/mark_as_finish`"
                        class="block w-full text-center py-2 rounded-lg bg-green-50 text-green-600 font-medium"
                    >
                        Marcar como concluído
                    </a>

                </div>
            </div>

        </div>

    @else
        <div class="text-center py-10 text-zinc-500">
            <p class="mb-2">Nenhum treino em andamento</p>
            <a href="{{ route('sessions.create') }}"
               class="inline-block px-4 py-2 rounded-lg bg-brand text-white">
                Iniciar Treino
            </a>
        </div>
    @endif
</x-main-layout>
