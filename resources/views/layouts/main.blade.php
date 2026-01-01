<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased overflow-y-scroll">
        <div class="min-h-screen bg-zinc-100 dark:bg-zinc-900">

            <header class="bg-white dark:bg-zinc-800 shadow">
                <div class="max-w-7xl text-center mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
                        {{ config('app.name') }}
                    </h2>
                </div>
            </header>

            <main>
                <div class="max-w-lg mx-auto px-4 py-6 space-y-6 pb-28">
                    <x-flash-message />
                    {{ $slot }}
                </div>
            </main>

            <x-bottom-nav />

            <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
        </div>
    </body>
</html>
