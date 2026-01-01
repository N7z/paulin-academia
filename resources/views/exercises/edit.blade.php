<x-main-layout>

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-zinc-900">
            Editar Exercício
        </h1>
        <p class="text-sm text-zinc-500">
            Atualize as informações do exercício
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('exercises.update', $exercise) }}"
        class="space-y-4"
    >
        @csrf
        @method('PUT')

        {{-- NOME --}}
        <div class="bg-white rounded-lg shadow-sm p-4">
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Nome do exercício
            </label>
            <input
                type="text"
                name="name"
                required
                value="{{ old('name', $exercise->name) }}"
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
                    <option
                        value="{{ $group->id }}"
                        @selected(old('muscle_group_id', $exercise->muscle_group_id) == $group->id)
                    >
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
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
                            @checked(old('weight_type', $exercise->weight_type) === $value)
                        >
                        <div
                            class="rounded-md border p-2
                            peer-checked:border-brand
                            peer-checked:bg-brand/10"
                        >
                            {{ $label }}
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- AÇÕES --}}
        <div class="space-y-2">
            <button
                type="submit"
                class="w-full h-12 rounded-lg bg-brand text-white font-medium hover:bg-brand-strong"
            >
                Salvar alterações
            </button>

            <a
                href="{{ route('exercises.index') }}"
                class="block w-full text-center text-sm text-zinc-500"
            >
                Cancelar
            </a>
        </div>

    </form>

</x-main-layout>
