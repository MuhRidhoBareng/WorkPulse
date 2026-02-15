<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SPNF SKB Kota Kotamobagu</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ================================================
               SPNF SKB — Premium App Layout
               ================================================ */

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
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }
            @keyframes shimmerLine {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            @keyframes glowPulse {
                0%, 100% { box-shadow: 0 0 15px rgba(245, 158, 11, 0.1); }
                50% { box-shadow: 0 0 25px rgba(245, 158, 11, 0.2); }
            }

            .animate-fade-in-up { animation: fadeInUp 0.5s ease-out both; }
            .animate-fade-in { animation: fadeIn 0.4s ease-out both; }
            .animate-slide-in-left { animation: slideInLeft 0.5s ease-out both; }
            .animate-slide-in-right { animation: slideInRight 0.5s ease-out both; }
            .animate-scale-in { animation: scaleIn 0.4s ease-out both; }
            .anim-delay-1 { animation-delay: 0.05s; }
            .anim-delay-2 { animation-delay: 0.1s; }
            .anim-delay-3 { animation-delay: 0.15s; }
            .anim-delay-4 { animation-delay: 0.2s; }
            .anim-delay-5 { animation-delay: 0.25s; }
            .anim-delay-6 { animation-delay: 0.3s; }

            /* Premium card hover */
            .card-premium {
                background: white;
                border-radius: 1rem;
                border: 1px solid rgba(0, 0, 0, 0.04);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
                position: relative;
            }
            .card-premium::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #2563EB, #F59E0B, #10B981);
                background-size: 200% 100%;
                animation: shimmerLine 4s ease infinite;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .card-premium:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12);
            }
            .card-premium:hover::before {
                opacity: 1;
            }

            /* Button premium */
            .btn-premium {
                background: linear-gradient(135deg, #1E40AF, #2563EB);
                transition: all 0.2s ease;
                position: relative;
                overflow: hidden;
            }
            .btn-premium:hover {
                transform: translateY(-2px) scale(1.02);
                box-shadow: 0 8px 25px -5px rgba(37, 99, 235, 0.4);
            }
            .btn-premium:active {
                transform: translateY(0) scale(0.98);
            }

            .btn-pulse {
                transition: all 0.2s ease;
            }
            .btn-pulse:hover {
                transform: scale(1.03);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            }
            .btn-pulse:active {
                transform: scale(0.97);
            }

            /* Page transition */
            main {
                animation: fadeIn 0.3s ease-out;
            }

            /* Table rows */
            tbody tr {
                transition: all 0.2s ease;
            }
            tbody tr:hover {
                background-color: rgba(37, 99, 235, 0.02);
            }

            /* Nav links */
            nav a {
                transition: all 0.2s ease;
            }

            /* Stat card with side accent */
            .stat-card {
                position: relative;
                padding-left: 1rem;
            }
            .stat-card::before {
                content: '';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 4px;
                height: 60%;
                border-radius: 0 4px 4px 0;
                transition: height 0.3s ease;
            }
            .stat-card:hover::before {
                height: 80%;
            }
            .stat-accent-blue::before { background: linear-gradient(180deg, #2563EB, #3B82F6); }
            .stat-accent-amber::before { background: linear-gradient(180deg, #F59E0B, #FBBF24); }
            .stat-accent-emerald::before { background: linear-gradient(180deg, #10B981, #34D399); }
            .stat-accent-violet::before { background: linear-gradient(180deg, #7C3AED, #8B5CF6); }
            .stat-accent-rose::before { background: linear-gradient(180deg, #F43F5E, #FB7185); }

            /* Footer */
            .footer-gradient {
                height: 3px;
                background: linear-gradient(90deg, #0F172A, #2563EB, #F59E0B, #10B981, #0F172A);
                background-size: 300% 100%;
                animation: gradientShift 6s ease infinite;
            }

            /* Icon hover */
            .icon-hover {
                transition: all 0.3s ease;
            }
            .icon-hover:hover {
                transform: scale(1.15) rotate(5deg);
            }

            /* Glass effect for alerts */
            .glass-alert {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100/80 animate-fade-in">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white/90 backdrop-blur-sm mt-auto border-t border-gray-100/50">
                <div class="footer-gradient"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-8 w-auto rounded">
                                <img src="{{ asset('images/logo-kotamobagu.png') }}" alt="Logo Kotamobagu" class="h-8 w-auto">
                            </div>
                            <div class="h-6 w-px bg-gray-200"></div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">SPNF SKB</p>
                                <p class="text-[11px] text-gray-400">Kota Kotamobagu</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SPNF SKB Kota Kotamobagu. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
