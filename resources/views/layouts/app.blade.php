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

        <!-- Animations -->
        <style>
            /* Fade In Up */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(24px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.5s ease-out both;
            }
            .animate-fade-in {
                animation: fadeIn 0.4s ease-out both;
            }
            .animate-slide-in-left {
                animation: slideInLeft 0.5s ease-out both;
            }
            .animate-scale-in {
                animation: scaleIn 0.4s ease-out both;
            }
            .anim-delay-1 { animation-delay: 0.05s; }
            .anim-delay-2 { animation-delay: 0.1s; }
            .anim-delay-3 { animation-delay: 0.15s; }
            .anim-delay-4 { animation-delay: 0.2s; }
            .anim-delay-5 { animation-delay: 0.25s; }
            .anim-delay-6 { animation-delay: 0.3s; }

            /* Card hover effect */
            .card-hover {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .card-hover:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
            }

            /* Smooth page transition */
            main {
                animation: fadeIn 0.3s ease-out;
            }

            /* Button pulse effect */
            .btn-pulse {
                transition: all 0.2s ease;
            }
            .btn-pulse:hover {
                transform: scale(1.02);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
            .btn-pulse:active {
                transform: scale(0.98);
            }

            /* Table row hover */
            tbody tr {
                transition: background-color 0.15s ease;
            }

            /* Smooth nav link underline */
            nav a {
                transition: all 0.2s ease;
            }

            /* Footer gradient line */
            .footer-gradient-line {
                height: 3px;
                background: linear-gradient(90deg, #1F4E79, #3B82F6, #8B5CF6, #EC4899);
                background-size: 200% 100%;
                animation: gradientShift 4s ease infinite;
            }
            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow animate-fade-in">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white mt-auto">
                <div class="footer-gradient-line"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo" class="h-8 w-auto">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">WorkPulse</p>
                                <p class="text-xs text-gray-400">Sistem Monitoring Kinerja — SKB Dinas Pendidikan</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SKB Dinas Pendidikan. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
