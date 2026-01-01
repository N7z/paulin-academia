<x-main-layout>
    {{-- TÍTULO --}}
    <div>
        <h1 class="text-xl font-semibold text-zinc-900">
            Meus Treinos
        </h1>
        <p class="text-sm text-zinc-500">
            Seus treinos organizados por dia
        </p>
    </div>

    {{-- TABS --}}
    <x-workout-tabs />

    {{-- CONTEÚDO --}}
    <div class="space-y-3">
        @forelse ($workouts as $workout)
            <a href="{{ route('workouts.show', $workout) }}">
                <div class="bg-white hover:bg-zinc-50 p-4 rounded-lg shadow-sm">
                    <p class="font-medium text-zinc-800">
                        {{ $workout->name }}
                    </p>
                    <p class="text-sm text-zinc-500">
                        {{ ucfirst(getDayLabel($workout->day)) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-sm text-zinc-500">
                Nenhum treino cadastrado.
            </p>
        @endforelse
    </div>

</x-main-layout>
