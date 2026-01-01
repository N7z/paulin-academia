<x-main-layout>

    {{-- HEADER --}}
    <div class="space-y-1">
        <h1 class="text-xl font-semibold text-zinc-900">
            Iniciar treino
        </h1>

        <p class="text-sm text-zinc-500">
            Escolha um treino para começar sua sessão
        </p>
    </div>

    {{-- INFO --}}
    @if (hasTrainedToday())
        <div class="bg-zinc-50 border border-zinc-200 rounded-sm p-2 text-sm text-zinc-600">
            Informação: Você já completou um treino hoje.
        </div>
    @endif

    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('sessions.store') }}"
        class="space-y-4 mt-4"
    >
        @csrf

        {{-- DATA INÍCIO --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Início do treino
            </label>

            <input
                type="text"
                readonly
                value="{{ now()->format('d/m/Y H:i') }}"
                class="w-full rounded-lg border-zinc-300 bg-zinc-100 text-zinc-600 cursor-not-allowed"
            >

            <input
                type="hidden"
                name="started_at"
                value="{{ now() }}"
            >
        </div>

        {{-- SELECT TREINO --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Treino
            </label>

            <select
                name="workout_id"
                required
                class="w-full rounded-lg border-zinc-300 focus:border-brand focus:ring-brand"
            >
                <option value="">Selecione um treino</option>

                @foreach ($workouts as $workout)
                    <option value="{{ $workout->id }}">
                        {{ $workout->name }} • {{ getDayLabel($workout->day) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- INFO --}}
        <div class="bg-zinc-50 border border-zinc-200 rounded-lg p-3 text-sm text-zinc-600">
            Ao iniciar o treino, você poderá registrar cargas, repetições
            e finalizar a sessão quando concluir.
        </div>

        {{-- ACTIONS --}}
        <div class="flex gap-2 pt-2">
            <a
                href="{{ route('workouts.index') }}"
                class="flex-1 text-center py-2 rounded-lg border border-zinc-300 text-zinc-700"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="flex-1 py-2 rounded-lg bg-brand text-white font-medium"
            >
                Iniciar treino
            </button>
        </div>

    </form>

</x-main-layout>
