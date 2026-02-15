<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi profil dan alamat email Anda.
        </p>
    </header>

    {{-- Foto Profil --}}
    <div class="mt-6 flex items-center gap-6">
        <div class="relative">
            @if(auth()->user()->profile_photo_url)
                <img src="{{ auth()->user()->profile_photo_url }}" alt="Foto Profil"
                    class="h-20 w-20 rounded-full object-cover border-2 border-gray-200">
            @else
                <div class="h-20 w-20 rounded-full bg-indigo-500 flex items-center justify-center border-2 border-gray-200">
                    <span class="text-2xl font-bold text-white">{{ auth()->user()->initials }}</span>
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-2">
            <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="flex items-center gap-3">
                @csrf
                <input type="file" name="photo" id="photo" accept="image/jpg,image/jpeg,image/png,image/webp"
                    class="text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    Upload
                </button>
            </form>

            @if(auth()->user()->profile_photo)
                <form method="POST" action="{{ route('profile.photo.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                        Hapus Foto
                    </button>
                </form>
            @endif

            @error('photo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            @if (session('status') === 'photo-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600">Foto berhasil diperbarui.</p>
            @endif

            @if (session('status') === 'photo-deleted')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600">Foto berhasil dihapus.</p>
            @endif

            <p class="text-xs text-gray-400">JPG, JPEG, PNG, atau WebP. Maksimal 2MB.</p>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Email Anda belum terverifikasi.

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Klik untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
