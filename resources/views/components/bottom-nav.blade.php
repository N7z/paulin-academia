@php
    $itemBase = 'inline-flex flex-col items-center justify-center px-5 hover:bg-neutral-secondary-medium group';
    $active = 'text-fg-brand';
    $inactive = 'text-body group-hover:text-fg-brand';
@endphp

<div class="
    fixed z-25
    w-[95vw] h-16 max-w-lg
    -translate-x-1/2 bottom-4 left-1/2
    rounded-full
    bg-white/75
    backdrop-blur-md
    shadow-sm
    border border-white/30
">
    <div class="grid h-full grid-cols-5 mx-auto">

        {{-- HOME --}}
        <a href="{{ route('dashboard') }}"
           class="{{ $itemBase }} rounded-s-full {{ request()->routeIs('dashboard') ? $active : $inactive }}">
            <svg class="w-8 h-8 text-zinc-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
            </svg>
            <span class="text-sm">Home</span>
        </a>

        {{-- TREINOS --}}
        <a href="{{ route('workouts.index') }}"
           class="{{ $itemBase }} {{ request()->routeIs('exercises.*') ||
                            request()->routeIs('workouts.*') ? $active : $inactive }}">
            <svg class="w-7 h-7 text-zinc-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z"/>
            </svg>
            <span class="text-sm">Treinos</span>
        </a>

        {{-- ADD --}}
        <div class="flex items-center justify-center">
            <a href="{{ addActionRoute() }}"
               class="inline-flex items-center justify-center w-10 h-10 rounded-full
              bg-brand hover:bg-brand-strong text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="1.5" d="M5 12h14m-7 7V5"/>
                </svg>
            </a>
        </div>

        {{-- PROGRESSO --}}
        <a href="{{ route('progress.index') }}"
           class="{{ $itemBase }} {{ request()->routeIs('progress.*') ? $active : $inactive }}">
            <svg class="w-7 h-7 text-zinc-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z"/>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z"/>
            </svg>
            <span class="text-sm">Progresso</span>
        </a>

        {{-- PERFIL --}}
        <a href="{{ route('profile.edit') }}"
           class="{{ $itemBase }} rounded-e-full {{ request()->routeIs('profile.*') ? $active : $inactive }}">
            <svg class="w-8 h-8 text-zinc-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="1.25" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <span class="text-sm">Perfil</span>
        </a>

    </div>
</div>
