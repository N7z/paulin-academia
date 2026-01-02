<x-main-layout>

    {{-- HEADER --}}
    <div class="space-y-1">
        <h1 class="text-xl font-semibold text-zinc-900">
            Progresso
        </h1>
        <p class="text-sm text-zinc-500">
            Últimos 30 dias
        </p>
    </div>

    {{-- RESUMO --}}
    <div class="grid grid-cols-3 gap-3">
        <div class="p-3 rounded-lg bg-white shadow-sm text-center">
            <p class="text-xs text-zinc-500">Treinos</p>
            <p class="font-semibold">{{ $workoutsCount }}</p>
        </div>

        <div class="p-3 rounded-lg bg-white shadow-sm text-center">
            <p class="text-xs text-zinc-500">Exercícios</p>
            <p class="font-semibold">{{ $exercisesCount }}</p>
        </div>

        <div class="p-3 rounded-lg bg-white shadow-sm text-center">
            <p class="text-xs text-zinc-500">Esforço médio</p>
            <p class="font-semibold">{{ number_format($avgDifficulty, 1) }}/2</p>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="bg-white rounded-lg shadow-sm p-4 space-y-3">
        <div>
            <label class="text-xs text-zinc-500">Exercício</label>
            <select class="w-full rounded-md border-zinc-300 text-sm">
                <option value="">Todos</option>
                @foreach ($exercises as $exercise)
                    <option value="{{ $exercise->id }}">
                        {{ $exercise->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button class="flex-1 py-2 rounded-md bg-zinc-100 text-sm">7 dias</button>
            <button class="flex-1 py-2 rounded-md bg-brand/10 text-brand text-sm font-medium">30 dias</button>
            <button class="flex-1 py-2 rounded-md bg-zinc-100 text-sm">90 dias</button>
        </div>
    </div>

    {{-- HISTÓRICO --}}
    <div class="space-y-3">
        <h2 class="text-sm font-medium text-zinc-700">
            Histórico
        </h2>

        @forelse ($history as $item)
            <div class="bg-white rounded-lg shadow-sm p-4 space-y-1">
                <div class="flex justify-between items-center">
                    <p class="font-medium text-zinc-800">
                        {{ $item->workoutExercise?->exercise?->name }}
                    </p>

                    <span
                        class="text-xs px-2 py-1 rounded-full
                        @if ($item->difficulty == 0) bg-green-100 text-green-700
                        @elseif ($item->difficulty == 1) bg-yellow-100 text-yellow-700
                        @else bg-red-100 text-red-700 @endif
                        "
                    >
                        {{ ['Fácil', 'Moderado', 'Difícil'][$item->difficulty] }}
                    </span>
                </div>

                <p class="text-sm text-zinc-500">
                    {{ $item->performed_sets }}x{{ $item->performed_reps }}
                    @if ($item->performed_weight)
                        • {{ $item->performed_weight }}
                        {{ $item->workoutExercise?->exercise?->weight_type }}
                    @endif
                </p>

                <p class="text-xs text-zinc-400">
                    {{ \Carbon\Carbon::parse($item->ended_at)->format('d/m/Y') }}
                </p>
            </div>
        @empty
            <div class="bg-zinc-50 rounded-lg p-4 text-sm text-zinc-500">
                Nenhum exercício registrado ainda.
            </div>
        @endforelse
    </div>

</x-main-layout>
