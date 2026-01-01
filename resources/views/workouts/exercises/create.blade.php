<x-main-layout>

    <div
        x-data="{
        muscleGroupId: '',
        exerciseId: '',
        exercises: [],
        selectedExercise: null,

        sets: '',
        reps: '',
        weight: '',
        weightType: 'kg',

        muscleGroups: {{ Js::from($muscleGroups) }}
    }">
        {{-- HEADER --}}
        <div class="space-y-1">
            <h1 class="text-xl font-semibold text-zinc-900">
                Adicionar exercício
            </h1>

            <p class="text-sm text-zinc-500">
                {{ $workout->name }} • {{ getDayLabel($workout->day) }}
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('workouts.exercises.store', $workout) }}"
            class="space-y-4"
        >
            @csrf

            {{-- GRUPO MUSCULAR --}}
            <div class="bg-white rounded-xl shadow-sm p-4 space-y-2">
                <label class="text-sm font-medium text-zinc-700">
                    Grupo muscular
                </label>

                <select
                    x-model="muscleGroupId"
                    class="w-full rounded-lg border-zinc-300"
                    @change="
                        const group = muscleGroups.find(g => g.id == muscleGroupId);
                        exercises = group ? group.exercises : [];
                        exerciseId = '';
                        selectedExercise = null;
                    "
                >
                    <option value="">Selecione</option>

                    <template x-for="group in muscleGroups" :key="group.id">
                        <option :value="group.id" x-text="group.name"></option>
                    </template>
                </select>
            </div>

            {{-- EXERCÍCIO --}}
            <div class="bg-white rounded-xl shadow-sm p-4 space-y-2">
                <label class="text-sm font-medium text-zinc-700">
                    Exercício
                </label>

                <select
                    name="exercise_id"
                    x-model="exerciseId"
                    :disabled="!exercises.length"
                    required
                    class="w-full rounded-lg border-zinc-300 disabled:bg-zinc-100"
                    @change="
                        selectedExercise = exercises.find(e => e.id == exerciseId);
                        sets = selectedExercise?.sets ?? '';
                        reps = selectedExercise?.reps ?? '';
                        weight = selectedExercise?.weight ?? '';
                        weightType = selectedExercise?.weight_type ?? 'kg';
                    "
                >
                    <option value="">Selecione</option>

                    <template x-for="exercise in exercises" :key="exercise.id">
                        <option :value="exercise.id" x-text="exercise.name"></option>
                    </template>
                </select>
            </div>

            {{-- CONFIGURAÇÃO --}}
            <div
                x-show="selectedExercise"
                x-transition
                x-cloak
                class="bg-white rounded-xl shadow-sm p-4 space-y-3"
            >
                <p class="text-sm font-medium text-zinc-700">
                    Configuração do treino
                </p>

                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="text-xs text-zinc-500">Sets</label>
                        <input
                            type="number"
                            name="sets"
                            min="1"
                            x-model="sets"
                            class="w-full rounded-lg border-zinc-300 text-center"
                        >
                    </div>

                    <div>
                        <label class="text-xs text-zinc-500">Reps</label>
                        <input
                            type="number"
                            name="reps"
                            min="1"
                            x-model="reps"
                            class="w-full rounded-lg border-zinc-300 text-center"
                        >
                    </div>

                    <div>
                        <label class="text-xs text-zinc-500">Peso</label>
                        <input
                            type="number"
                            name="weight"
                            step="0.5"
                            x-model="weight"
                            class="w-full rounded-lg border-zinc-300 text-center"
                        >
                    </div>
                </div>

                {{-- TIPO --}}
                <div class="flex gap-2">
                    <template x-for="type in ['kg','lb','unit']" :key="type">
                        <label class="flex-1 text-center cursor-pointer">
                            <input
                                type="radio"
                                name="weight_type"
                                :value="type"
                                class="peer hidden"
                                x-model="weightType"
                            >
                            <div
                                class="py-2 rounded-lg border text-sm
                                peer-checked:border-brand
                                peer-checked:bg-brand/10
                                peer-checked:text-brand"
                                x-text="type"
                            ></div>
                        </label>
                    </template>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="flex gap-2 pt-2">
                <a
                    href="{{ route('workouts.show', $workout) }}"
                    class="flex-1 text-center py-2 rounded-lg border border-zinc-300 text-zinc-700"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="flex-1 py-2 rounded-lg bg-brand text-white font-medium"
                >
                    Adicionar
                </button>
            </div>

        </form>

    </div>

</x-main-layout>
