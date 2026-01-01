<x-main-layout>

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-zinc-900">
            Novo Exercício
        </h1>
        <p class="text-sm text-zinc-500">
            Adicione um exercício ao seu catálogo
        </p>
    </div>

    <form method="POST" action="{{ route('exercises.store') }}" class="space-y-4">
        @csrf

        {{-- NOME --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Nome do exercício
            </label>
            <input
                type="text"
                name="name"
                required
                placeholder="Ex: Supino reto"
                class="w-full rounded-md border-zinc-300 focus:border-brand focus:ring-brand"
            >
        </div>

        {{-- GRUPO MUSCULAR --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Grupo muscular
            </label>
            <select
                name="muscle_group_id"
                required
                class="w-full rounded-md border-zinc-300 focus:border-brand focus:ring-brand"
            >
                <option value="">Selecione</option>
                @foreach ($muscleGroups as $group)
                    <option value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PARÂMETROS --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <label class="text-sm text-zinc-600">Séries</label>
                <input
                    type="number"
                    name="sets"
                    min="0"
                    placeholder="3"
                    class="w-full rounded-md border-zinc-300"
                >
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4">
                <label class="text-sm text-zinc-600">Reps</label>
                <input
                    type="number"
                    name="reps"
                    min="0"
                    placeholder="10"
                    class="w-full rounded-md border-zinc-300"
                >
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4">
                <label class="text-sm text-zinc-600">Carga</label>
                <input
                    type="number"
                    step="0.5"
                    min="0"
                    name="weight"
                    placeholder="40"
                    class="w-full rounded-md border-zinc-300"
                >
            </div>
        </div>

        {{-- TIPO DE CARGA --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-2">
                Tipo de carga
            </label>

            <div class="flex gap-2">
                @foreach (['kg' => 'Kg', 'lb' => 'Lb', 'unit' => 'Unidade'] as $value => $label)
                    <label class="flex-1 text-center cursor-pointer">
                        <input
                            type="radio"
                            name="weight_type"
                            value="{{ $value }}"
                            class="peer hidden"
                            {{ $value === 'kg' ? 'checked' : '' }}
                        >
                        <div class="rounded-md border p-2
                            peer-checked:border-brand
                            peer-checked:bg-brand/10">
                            {{ $label }}
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- BOTÃO --}}
        <button
            type="submit"
            class="w-full h-12 rounded-lg bg-brand text-white font-medium hover:bg-brand-strong">
            Salvar exercício
        </button>
    </form>

</x-main-layout>
