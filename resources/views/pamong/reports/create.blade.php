<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Buat Laporan Kegiatan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 animate-fade-in-up anim-delay-1">
                <form method="POST" action="{{ route('pamong.reports.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul Kegiatan --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Pelatihan Keterampilan Digital">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Kegiatan --}}
                    <div class="mb-4">
                        <label for="activity_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="activity_date" id="activity_date" value="{{ old('activity_date', date('Y-m-d')) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('activity_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kegiatan</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Jelaskan detail kegiatan pelatihan yang dilakukan...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Dokumen Bukti --}}
                    <div class="mb-6">
                        <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Foto / Dokumen Bukti Kegiatan</label>
                        <input type="file" name="document" id="document" accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">

                        <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-md">
                            <div class="flex items-start gap-2">
                                <svg class="h-5 w-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-amber-800">Ketentuan Foto Bukti:</p>
                                    <ul class="text-xs text-amber-700 mt-1 list-disc list-inside space-y-0.5">
                                        <li><strong>Foto harus menyertakan timestamp</strong> (tanggal & waktu) yang terlihat jelas</li>
                                        <li>Aktifkan fitur timestamp di kamera HP atau gunakan aplikasi timestamp camera</li>
                                        <li>Format file: PDF, JPG, JPEG, PNG (maksimal 2MB)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @error('document')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('pamong.reports.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
