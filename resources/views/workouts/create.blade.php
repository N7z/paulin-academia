<x-main-layout>

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-zinc-900">
            Novo Treino
        </h1>
        <p class="text-sm text-zinc-500">
            Crie um treino base para a semana
        </p>
    </div>

    <form method="POST" action="{{ route('workouts.store') }}" class="space-y-4">
        @csrf

        {{-- NOME --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Nome do treino
            </label>
            <input
                type="text"
                name="name"
                required
                placeholder="Ex: Treino A - Peito e Tríceps"
                class="w-full rounded-md border-zinc-300 focus:border-brand focus:ring-brand"
            >
        </div>

        {{-- DIA DA SEMANA --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label for="day" class="block text-sm font-medium text-zinc-700 mb-2">
                Dia da semana
            </label>

            <select
                id="day"
                name="day"
                required
                class="w-full rounded-md border-zinc-300 text-sm
               focus:border-brand focus:ring-brand"
            >
                <option value="" disabled selected>
                    Selecione um dia
                </option>

                @for ($day = 1; $day <= 7; $day++)
                    <option value="{{ $day }}">
                        {{ getDayLabel($day) }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- OBSERVAÇÕES --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Observações (opcional)
            </label>
            <textarea
                name="notes"
                rows="3"
                placeholder="Ex: Foco em carga progressiva"
                class="w-full rounded-md border-zinc-300 focus:border-brand focus:ring-brand"
            ></textarea>
        </div>

        {{-- BOTÃO --}}
        <button
            type="submit"
            class="w-full h-12 rounded-lg bg-brand text-white font-medium hover:bg-brand-strong">
            Salvar treino
        </button>
    </form>

</x-main-layout>
