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
    <body class="font-sans text-slate-900 antialiased h-full bg-slate-50 selection:bg-emerald-500 selection:text-white">
        
        <!-- Ambient Background Glow & Micro Patterns -->
        <div class="fixed inset-0 min-h-screen overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-400/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 -right-40 w-96 h-96 bg-teal-400/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 left-1/3 w-96 h-96 bg-emerald-300/20 rounded-full blur-3xl"></div>
            <!-- Subtle Radial Grid Texture -->
            <div class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] opacity-60"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col justify-center items-center px-4 py-8 sm:px-6 lg:px-8">
            
            <!-- Brand Emblem & Title -->
            <div class="mb-8 text-center flex flex-col items-center">
                <a href="/" class="group inline-flex items-center gap-3 transition-transform duration-200 hover:scale-[1.02]">
                    <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl shadow-lg shadow-emerald-600/25 ring-1 ring-white/20 group-hover:shadow-emerald-600/35 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-2xl font-extrabold tracking-tight bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 bg-clip-text text-transparent">
                            CareTrack
                        </span>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-emerald-600">
                            Healthcare Network
                        </span>
                    </div>
                </a>
            </div>

            <!-- Form Container Card -->
            <div class="w-full sm:max-w-md bg-white/90 backdrop-blur-md border border-slate-200/80 shadow-2xl shadow-slate-900/5 rounded-2xl p-6 sm:p-8 transition-all">
                {{ $slot }}
            </div>

            <!-- Global Footer / Trust Badge -->
            <div class="mt-8 text-center text-xs text-slate-400 flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/>
                </svg>
                <span>HIPAA Compliant &amp; Encrypted Healthcare Portal</span>
            </div>
            
        </div>
    </body>
</html>