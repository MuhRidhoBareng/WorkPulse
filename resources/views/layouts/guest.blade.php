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
               SPNF SKB — Premium Login Page v2
               ================================================ */

            /* Animated mesh gradient background */
            .bg-premium {
                background: #0a0e1a;
                position: relative;
                overflow: hidden;
            }
            .bg-premium::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(ellipse 80% 50% at 20% 40%, rgba(37, 99, 235, 0.15) 0%, transparent 60%),
                    radial-gradient(ellipse 60% 40% at 80% 20%, rgba(139, 92, 246, 0.12) 0%, transparent 50%),
                    radial-gradient(ellipse 50% 60% at 60% 80%, rgba(16, 185, 129, 0.08) 0%, transparent 50%),
                    radial-gradient(ellipse 40% 30% at 40% 60%, rgba(245, 158, 11, 0.06) 0%, transparent 50%);
                animation: meshFloat 20s ease-in-out infinite;
            }
            .bg-premium::after {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(circle at 25% 25%, rgba(37, 99, 235, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 75% 75%, rgba(245, 158, 11, 0.06) 0%, transparent 40%);
                animation: meshFloat 25s ease-in-out infinite reverse;
            }
            @keyframes meshFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(2%, -3%) scale(1.02); }
                66% { transform: translate(-1.5%, 2%) scale(0.98); }
            }

            /* Grid pattern overlay */
            .grid-overlay {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
                background-size: 60px 60px;
                pointer-events: none;
            }

            /* Floating particles */
            .particles {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
            }
            .particle {
                position: absolute;
                border-radius: 50%;
                animation: particleFloat linear infinite;
            }
            .particle:nth-child(1) { left: 8%; width: 3px; height: 3px; background: rgba(245, 158, 11, 0.4); animation-duration: 14s; animation-delay: 0s; }
            .particle:nth-child(2) { left: 20%; width: 2px; height: 2px; background: rgba(37, 99, 235, 0.5); animation-duration: 18s; animation-delay: 2s; }
            .particle:nth-child(3) { left: 35%; width: 4px; height: 4px; background: rgba(16, 185, 129, 0.3); animation-duration: 16s; animation-delay: 4s; }
            .particle:nth-child(4) { left: 50%; width: 2px; height: 2px; background: rgba(139, 92, 246, 0.4); animation-duration: 20s; animation-delay: 1s; }
            .particle:nth-child(5) { left: 65%; width: 3px; height: 3px; background: rgba(245, 158, 11, 0.3); animation-duration: 15s; animation-delay: 3s; }
            .particle:nth-child(6) { left: 80%; width: 2px; height: 2px; background: rgba(37, 99, 235, 0.4); animation-duration: 22s; animation-delay: 5s; }
            .particle:nth-child(7) { left: 92%; width: 3px; height: 3px; background: rgba(16, 185, 129, 0.35); animation-duration: 17s; animation-delay: 6s; }
            .particle:nth-child(8) { left: 42%; width: 2px; height: 2px; background: rgba(139, 92, 246, 0.3); animation-duration: 19s; animation-delay: 7s; }

            @keyframes particleFloat {
                0% { transform: translateY(110vh) scale(0); opacity: 0; }
                5% { opacity: 1; transform: translateY(100vh) scale(0.5); }
                50% { opacity: 0.8; transform: translateY(50vh) scale(1); }
                95% { opacity: 0.3; }
                100% { transform: translateY(-10vh) scale(0.3); opacity: 0; }
            }

            /* Glassmorphism card */
            .glass-card {
                background: rgba(255, 255, 255, 0.97);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow:
                    0 32px 64px -16px rgba(0, 0, 0, 0.5),
                    0 0 0 1px rgba(255, 255, 255, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.3);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glass-card:hover {
                transform: translateY(-4px);
                box-shadow:
                    0 40px 80px -20px rgba(0, 0, 0, 0.55),
                    0 0 60px rgba(37, 99, 235, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.4);
            }

            /* Keyframes */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.85) translateY(10px); }
                to { opacity: 1; transform: scale(1) translateY(0); }
            }
            @keyframes slideFromLeft {
                from { opacity: 0; transform: translateX(-30px) rotate(-5deg); }
                to { opacity: 1; transform: translateX(0) rotate(0); }
            }
            @keyframes slideFromRight {
                from { opacity: 0; transform: translateX(30px) rotate(5deg); }
                to { opacity: 1; transform: translateX(0) rotate(0); }
            }
            @keyframes shimmerLine {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            @keyframes glowPulse {
                0%, 100% { box-shadow: 0 0 20px rgba(37, 99, 235, 0.15), 0 0 40px rgba(37, 99, 235, 0.05); }
                50% { box-shadow: 0 0 30px rgba(37, 99, 235, 0.25), 0 0 60px rgba(37, 99, 235, 0.1); }
            }
            @keyframes textReveal {
                from { opacity: 0; letter-spacing: 0.3em; }
                to { opacity: 1; letter-spacing: 0.15em; }
            }
            @keyframes borderDraw {
                from { stroke-dashoffset: 100; }
                to { stroke-dashoffset: 0; }
            }

            .animate-fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
            .animate-scale-in { animation: scaleIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
            .animate-slide-left { animation: slideFromLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
            .animate-slide-right { animation: slideFromRight 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
            .animate-text-reveal { animation: textReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; }
            .anim-delay-1 { animation-delay: 0.1s; }
            .anim-delay-2 { animation-delay: 0.2s; }
            .anim-delay-3 { animation-delay: 0.35s; }
            .anim-delay-4 { animation-delay: 0.5s; }
            .anim-delay-5 { animation-delay: 0.65s; }

            /* Logo badge */
            .logo-badge {
                padding: 8px;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 18px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .logo-badge:hover {
                transform: scale(1.08) translateY(-4px);
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2), 0 0 30px rgba(37, 99, 235, 0.08);
            }

            /* Premium button */
            .btn-login {
                background: linear-gradient(135deg, #1E40AF 0%, #2563EB 40%, #3B82F6 100%);
                background-size: 200% 200%;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                letter-spacing: 0.08em;
            }
            .btn-login::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.6s ease;
            }
            .btn-login:hover {
                background-position: 100% 0;
                transform: translateY(-2px);
                box-shadow: 0 12px 30px rgba(37, 99, 235, 0.45), 0 4px 12px rgba(37, 99, 235, 0.2);
            }
            .btn-login:hover::before { left: 100%; }
            .btn-login:active { transform: translateY(0) scale(0.98); }

            .btn-outline-register {
                border: 2px solid rgba(37, 99, 235, 0.25);
                background: transparent;
                color: #2563EB;
                transition: all 0.3s ease;
                letter-spacing: 0.02em;
            }
            .btn-outline-register:hover {
                border-color: #2563EB;
                background: rgba(37, 99, 235, 0.05);
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.12);
            }

            /* Input styling */
            .input-premium {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1.5px solid #E2E8F0;
                background: rgba(248, 250, 252, 0.5);
            }
            .input-premium:focus {
                border-color: #2563EB;
                background: white;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08), 0 2px 10px rgba(37, 99, 235, 0.06);
            }

            /* Accent lines */
            .accent-line-top {
                height: 3px;
                background: linear-gradient(90deg, #2563EB, #F59E0B, #10B981, #8B5CF6);
                background-size: 300% 100%;
                animation: shimmerLine 4s ease infinite;
                border-radius: 999px 999px 0 0;
            }
            .gold-line {
                height: 2px;
                background: linear-gradient(90deg, transparent, #F59E0B, #D97706, #F59E0B, transparent);
                background-size: 200% 100%;
                animation: shimmerLine 3s ease infinite;
            }

            /* Glow ring around card */
            .glow-ring {
                animation: glowPulse 4s ease-in-out infinite;
                border-radius: 1.25rem;
            }

            /* Role info panel */
            .role-panel {
                background: linear-gradient(135deg, rgba(37, 99, 235, 0.06) 0%, rgba(139, 92, 246, 0.04) 100%);
                border: 1px solid rgba(37, 99, 235, 0.12);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 bg-premium relative">
            {{-- Grid overlay --}}
            <div class="grid-overlay"></div>

            {{-- Floating particles --}}
            <div class="particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>

            <div class="relative z-10 w-full max-w-md">
                {{-- Dual Logo & Branding --}}
                <div class="text-center mb-8 animate-fade-in-up">
                    <div class="flex items-center justify-center gap-5 mb-5">
                        <div class="logo-badge animate-slide-left">
                            <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-16 sm:h-[4.5rem] w-auto rounded-xl">
                        </div>
                        <div class="animate-scale-in anim-delay-1 flex flex-col items-center gap-1">
                            <div class="w-px h-4 bg-gradient-to-b from-transparent to-amber-400/50"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-amber-400/60"></div>
                            <div class="w-px h-4 bg-gradient-to-b from-amber-400/50 to-transparent"></div>
                        </div>
                        <div class="logo-badge animate-slide-right anim-delay-1">
                            <img src="{{ asset('images/logo-kotamobagu.png') }}" alt="Logo Kota Kotamobagu" class="h-16 sm:h-[4.5rem] w-auto rounded-xl">
                        </div>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight animate-fade-in-up anim-delay-2">
                        SPNF SKB
                    </h1>
                    <p class="text-amber-400 font-bold text-sm tracking-[0.15em] uppercase animate-text-reveal anim-delay-3 mt-1">
                        KOTA KOTAMOBAGU
                    </p>
                    <p class="text-slate-400 text-xs mt-2 animate-fade-in-up anim-delay-4">
                        Satuan Pendidikan Nonformal
                    </p>
                </div>

                {{-- Login Card --}}
                <div class="glow-ring">
                    <div class="glass-card rounded-2xl overflow-hidden animate-scale-in anim-delay-3">
                        <div class="accent-line-top"></div>
                        <div class="px-7 py-8 sm:px-9">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-10 text-center animate-fade-in-up anim-delay-5">
                    <div class="gold-line w-20 mx-auto mb-4"></div>
                    <p class="text-slate-500 text-xs">&copy; {{ date('Y') }} SPNF SKB Kota Kotamobagu</p>
                    <p class="text-slate-600 text-[10px] mt-1.5">
                        Dinas Pendidikan — Kota Kotamobagu
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
