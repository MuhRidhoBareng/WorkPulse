<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Info Panel --}}
    <div class="mb-5 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h3 class="text-sm font-semibold text-blue-800 mb-2">Masuk Sesuai Role Anda:</h3>
        <ul class="text-xs text-blue-700 space-y-1">
            <li>👩‍🏫 <strong>Pamong</strong> — Clock in/out, upload laporan kegiatan</li>
            <li>📋 <strong>TU (Admin)</strong> — Kelola data pengguna, verifikasi laporan</li>
            <li>👔 <strong>Kepala SKB</strong> — Lihat rekap kinerja, evaluasi pamong</li>
        </ul>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Masukkan password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
            </label>
        </div>

        <div class="mt-5">
            <x-primary-button class="w-full justify-center py-3 text-sm">
                Masuk
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-xs text-gray-500 hover:text-gray-700 underline" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>
    </form>

    {{-- Register Link --}}
    <div class="mt-6 pt-5 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-600">Belum punya akun?</p>
        <a href="{{ route('register') }}" class="mt-2 inline-flex items-center justify-center w-full px-4 py-2.5 bg-white border-2 border-indigo-500 text-indigo-600 rounded-lg text-sm font-semibold hover:bg-indigo-50 transition">
            Daftar Akun Baru
        </a>
        <p class="text-xs text-gray-400 mt-2">Akun baru perlu diaktifkan oleh TU setelah mendaftar</p>
    </div>
</x-guest-layout>
