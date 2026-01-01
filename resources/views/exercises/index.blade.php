<x-main-layout>

    <div
        x-data="{
            open: false,
            exercise: null
        }"
        class="space-y-4"
    >

        {{-- TÍTULO --}}
        <div>
            <h1 class="text-xl font-semibold text-zinc-900">
                Exercícios
            </h1>
            <p class="text-sm text-zinc-500">
                Catálogo de exercícios
            </p>
        </div>

        {{-- TABS --}}
        <x-workout-tabs />

        {{-- LISTA --}}
        <div class="space-y-3">
            @foreach ($muscleGroups as $group)
                <details class="group bg-white rounded-lg shadow-sm">
                    <summary class="flex justify-between px-4 py-3 cursor-pointer">
                        <span class="font-medium text-zinc-800">
                            {{ $group->name }}
                        </span>
                        <svg class="w-5 h-5 text-zinc-400 rotate-90 group-open:rotate-0 transition">
                            <path stroke="currentColor" stroke-width="1" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>

                    <div class="px-4 pb-4 space-y-2">
                        @foreach ($group->exercises as $exercise)
                            <div
                                class="p-3 bg-zinc-50 rounded cursor-pointer hover:bg-zinc-100 transition"
                                @click="
                                    open = true;
                                    exercise = {
                                        id: {{ $exercise->id }},
                                        name: '{{ $exercise->name }}',
                                        muscle: '{{ $group->name }}',
                                        workouts: {{ $exercise->workoutExercises?->count() ?? 0 }},
                                        sessions: {{ $exercise->sessionExercises?->count() ?? 0 }},
                                        workoutList: {{ Js::from(
                                            $exercise->workoutExercises
                                                ->pluck('workout.name')
                                                ->unique()
                                                ->values()
                                        ) }}
                                    }
                                "
                            >
                                {{ $exercise->name }}
                            </div>
                        @endforeach
                    </div>
                </details>
            @endforeach
        </div>

        {{-- OVERLAY --}}
        <template x-teleport="body">
            <div
                x-show="open"
                x-transition.opacity
                class="fixed inset-0 bg-black/40 z-40"
                @click="open = false"
            ></div>
        </template>

        {{-- BOTTOM SHEET --}}
        <div
            x-show="open"
            x-transition
            class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl p-5 max-h-[85vh] overflow-y-auto"
        >
            <div class="w-12 h-1 bg-zinc-300 rounded-full mx-auto mb-4"></div>

            <template x-if="exercise">
                <div class="space-y-4">

                    {{-- HEADER --}}
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900" x-text="exercise.name"></h3>
                        <p class="text-sm text-zinc-500" x-text="exercise.muscle"></p>
                    </div>

                    {{-- STATS --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-zinc-50 rounded text-center">
                            <p class="text-xs text-zinc-500">Usado em treinos</p>
                            <p class="font-semibold" x-text="exercise.workouts"></p>
                        </div>

                        <div class="p-3 bg-zinc-50 rounded text-center">
                            <p class="text-xs text-zinc-500">Execuções</p>
                            <p class="font-semibold" x-text="exercise.sessions"></p>
                        </div>
                    </div>

                    {{-- TREINOS --}}
                    <div>
                        <p class="text-sm font-medium text-zinc-700 mb-1">
                            Treinos
                        </p>

                        <template x-if="exercise.workoutList.length">
                            <div class="space-y-1">
                                <template x-for="name in exercise.workoutList" :key="name">
                                    <div class="text-sm px-3 py-2 bg-zinc-100 rounded">
                                        <span x-text="name"></span>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="!exercise.workoutList.length">
                            <p class="text-sm text-zinc-400">
                                Ainda não utilizado em treinos
                            </p>
                        </template>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="space-y-2 pt-2">
                        <a
                            :href="`/exercises/${exercise.id}/edit`"
                            class="block w-full text-center py-2 rounded-lg bg-brand text-white font-medium"
                        >
                            Editar exercício
                        </a>

                        <form method="post" :action="`/exercises/${exercise.id}`">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="block w-full text-center py-2 rounded-lg bg-red-50 text-red-600 font-medium">
                                Remover exercício
                            </button>
                        </form>

                        <button
                            @click="open = false"
                            class="w-full py-2 text-sm text-zinc-500"
                        >
                            Fechar
                        </button>
                    </div>

                </div>
            </template>
        </div>

    </div>

</x-main-layout>
