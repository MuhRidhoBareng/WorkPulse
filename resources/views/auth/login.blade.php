<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Role Info Panel --}}
    <div class="mb-6 p-4 rounded-xl role-panel animate-fade-in-up anim-delay-1">
        <h3 class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            Masuk Sesuai Role
        </h3>
        <div class="space-y-1.5">
            <div class="flex items-center gap-2 text-xs text-gray-600 py-1 px-2 rounded-lg hover:bg-blue-50/60 transition-colors">
                <span class="w-5 h-5 rounded-md bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                    </svg>
                </span>
                <span><strong class="text-gray-800">Pamong</strong> — Clock in/out, upload laporan</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-600 py-1 px-2 rounded-lg hover:bg-blue-50/60 transition-colors">
                <span class="w-5 h-5 rounded-md bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                    </svg>
                </span>
                <span><strong class="text-gray-800">TU (Admin)</strong> — Kelola pengguna, verifikasi</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-600 py-1 px-2 rounded-lg hover:bg-blue-50/60 transition-colors">
                <span class="w-5 h-5 rounded-md bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </span>
                <span><strong class="text-gray-800">Kepala SKB</strong> — Monitoring & rekap kinerja</span>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="animate-fade-in-up anim-delay-2">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="contoh@email.com"
                   class="block w-full rounded-xl px-4 py-3 text-sm input-premium focus:outline-none" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 animate-fade-in-up anim-delay-3">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="Masukkan password"
                   class="block w-full rounded-xl px-4 py-3 text-sm input-premium focus:outline-none" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4 animate-fade-in-up anim-delay-3">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-xs text-blue-500 hover:text-blue-700 font-medium transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-6 animate-fade-in-up anim-delay-4">
            <button type="submit" class="w-full py-3.5 rounded-xl text-white text-sm font-bold uppercase tracking-wider btn-login shadow-lg">
                MASUK
            </button>
        </div>
    </form>

    {{-- Register Link --}}
    <div class="mt-7 pt-6 border-t border-gray-100 text-center animate-fade-in-up anim-delay-5">
        <p class="text-sm text-gray-500 mb-3">Belum punya akun?</p>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center w-full px-4 py-3 rounded-xl text-sm font-semibold btn-outline-register">
            Daftar Akun Baru
        </a>
        <p class="text-[11px] text-gray-400 mt-2.5">Akun baru perlu diaktifkan oleh TU setelah mendaftar</p>
    </div>
</x-guest-layout>
