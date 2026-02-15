<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WorkPulse') }} — SKB Dinas Pendidikan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50">

            {{-- Logo & Branding --}}
            <div class="text-center mb-2">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-24 w-auto mx-auto">
                </a>
                <h1 class="mt-3 text-xl font-bold text-gray-800">WorkPulse</h1>
                <p class="text-sm text-gray-500">Sistem Monitoring Kinerja — SKB Dinas Pendidikan</p>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-100">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-gray-400">&copy; {{ date('Y') }} SKB Dinas Pendidikan. All rights reserved.</p>
        </div>
    </body>
</html>
