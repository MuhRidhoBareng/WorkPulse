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

        <style>
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(24px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.92); }
                to { opacity: 1; transform: scale(1); }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out both;
            }
            .animate-scale-in {
                animation: scaleIn 0.5s ease-out both;
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            .anim-delay-1 { animation-delay: 0.1s; }
            .anim-delay-2 { animation-delay: 0.2s; }
            .anim-delay-3 { animation-delay: 0.3s; }

            .login-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .login-card:hover {
                box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12);
            }

            .btn-auth {
                transition: all 0.2s ease;
            }
            .btn-auth:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            }
            .btn-auth:active {
                transform: translateY(0);
            }

            /* Footer gradient line */
            .footer-gradient-line-sm {
                height: 2px;
                width: 80px;
                margin: 0 auto 0.5rem;
                background: linear-gradient(90deg, #3B82F6, #8B5CF6, #EC4899);
                border-radius: 999px;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50">

            {{-- Logo & Branding --}}
            <div class="text-center mb-2 animate-fade-in-up">
                <a href="/" class="inline-block animate-float">
                    <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-24 w-auto mx-auto">
                </a>
                <h1 class="mt-3 text-xl font-bold text-gray-800">WorkPulse</h1>
                <p class="text-sm text-gray-500">Sistem Monitoring Kinerja — SKB Dinas Pendidikan</p>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-100 login-card animate-scale-in anim-delay-1">
                {{ $slot }}
            </div>

            <div class="mt-6 animate-fade-in-up anim-delay-3">
                <div class="footer-gradient-line-sm"></div>
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SKB Dinas Pendidikan. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
