@php
    $type = session('success') ? 'success' : (session('error') ? 'error' : null);
    $message = session('success') ?? session('error');
@endphp

@if ($message)
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="rounded-lg px-4 py-3 text-sm shadow
            {{ $type === 'success'
                ? 'bg-emerald-100 text-emerald-800'
                : 'bg-red-100 text-red-800' }}"
    >
        {{ $message }}
    </div>
@endif
