<x-main-layout>

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

    {{-- ACORDEÃO --}}
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
                        <div class="p-3 bg-zinc-50 rounded">
                            {{ $exercise->name }}
                        </div>
                    @endforeach
                </div>
            </details>
        @endforeach
    </div>

</x-main-layout>
