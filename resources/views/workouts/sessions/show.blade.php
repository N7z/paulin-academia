<x-main-layout>

    <div class="space-y-4">

        {{-- HEADER --}}
        <div>
            <h1 class="text-xl font-semibold text-zinc-900">
                {{ $sessionExercise->workoutExercise->exercise->name }}
            </h1>

            <p class="text-sm text-zinc-500">
                {{ $sessionExercise->workoutExercise->exercise->muscleGroup->name ?? '' }}
            </p>
        </div>

        {{-- PLANEJADO --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-xs text-zinc-500 mb-1">Planejado</p>

            <p class="font-medium text-zinc-800">
                {{ $sessionExercise->workoutExercise->sets }}x{{ $sessionExercise->workoutExercise->reps }}
                @if ($sessionExercise->workoutExercise->weight)
                    • {{ $sessionExercise->workoutExercise->weight }}
                    {{ $sessionExercise->workoutExercise->exercise->weight_type }}
                @endif
            </p>
        </div>

        {{-- FORM DE EXECUÇÃO --}}
        <form
            method="POST"
            action="{{ route('sessions.exercises.finish', $sessionExercise) }}"
            class="space-y-4"
        >
            @csrf

            {{-- EXECUTADO --}}
            <div class="bg-white rounded-lg shadow-sm p-4 space-y-3">
                <p class="text-sm font-medium text-zinc-700">
                    Executado
                </p>

                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="text-xs text-zinc-500">Séries</label>
                        <input
                            type="number"
                            name="performed_sets"
                            value="{{ $sessionExercise->workoutExercise->sets }}"
                            min="0"
                            class="w-full rounded-md border-zinc-300"
                        >
                    </div>

                    <div>
                        <label class="text-xs text-zinc-500">Reps</label>
                        <input
                            type="number"
                            name="performed_reps"
                            value="{{ $sessionExercise->workoutExercise->reps }}"
                            min="0"
                            class="w-full rounded-md border-zinc-300"
                        >
                    </div>

                    <div>
                        <label class="text-xs text-zinc-500">Carga</label>
                        <input
                            type="number"
                            step="0.5"
                            name="performed_weight"
                            value="{{ $sessionExercise->workoutExercise->weight }}"
                            class="w-full rounded-md border-zinc-300"
                        >
                    </div>
                </div>
            </div>

            {{-- DIFICULDADE / ESFORÇO --}}
            <div
                x-data="{ difficulty: 1 }"
                class="bg-white rounded-lg shadow-sm p-4 space-y-3"
            >
                <div class="flex justify-between items-center">
                    <p class="text-sm font-medium text-zinc-700">
                        Dificuldade
                    </p>

                    <span
                        class="text-xs font-medium px-2 py-1 rounded-full"
                        :class="{
                'bg-green-100 text-green-700': difficulty == 0,
                'bg-yellow-100 text-yellow-700': difficulty == 1,
                'bg-red-100 text-red-700': difficulty == 2
            }"
                        x-text="difficulty == 0 ? 'Fácil' : difficulty == 1 ? 'Moderado' : 'Difícil'"
                    ></span>
                </div>

                <input
                    type="range"
                    name="difficulty"
                    min="0"
                    max="2"
                    step="1"
                    x-model="difficulty"
                    class="w-full accent-brand"
                />

                <div class="flex justify-between text-xs text-zinc-400">
                    <span>Fácil</span>
                    <span>Moderado</span>
                    <span>Difícil</span>
                </div>
            </div>

            {{-- OBSERVAÇÃO --}}
            <div class="bg-white rounded-lg shadow-sm p-4">
                <label class="text-sm font-medium text-zinc-700 mb-1 block">
                    Observação
                </label>

                <textarea
                    name="notes"
                    rows="3"
                    placeholder="Ex: falhou na última série, carga pesada..."
                    class="w-full rounded-md border-zinc-300 text-sm"
                ></textarea>
            </div>

            {{-- AÇÕES --}}
            <div class="space-y-2">

                {{-- FINALIZAÇÃO NORMAL --}}
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-brand text-white font-medium"
                >
                    Finalizar exercício
                </button>

                {{-- CANCELAR --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="block w-full text-center py-2 rounded-lg text-zinc-500 text-sm"
                >
                    Cancelar
                </a>

            </div>
        </form>

    </div>

</x-main-layout>
