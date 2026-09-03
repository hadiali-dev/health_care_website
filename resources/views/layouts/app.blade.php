<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CareTrack') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 min-h-screen">
        <div class="min-h-screen bg-slate-50">
            <!-- Header Slot (CareTrack Navbar Only) -->
            @if (isset($header))
                <header class="bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 shadow-sm">
                    <div class="max-w-7xl mx-auto py-3.5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Main Content -->
            <main class="py-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>