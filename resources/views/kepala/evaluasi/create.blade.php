<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Beri Evaluasi Kinerja</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('kepala.evaluasi.store') }}">
                    @csrf

                    {{-- Pilih Pamong --}}
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pamong</label>
                        <select name="user_id" id="user_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Pamong --</option>
                            @foreach($pamongs as $pamong)
                                <option value="{{ $pamong->id }}" {{ old('user_id') == $pamong->id ? 'selected' : '' }}>
                                    {{ $pamong->name }} (NIP: {{ $pamong->nip }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Periode --}}
                    <div class="mb-4">
                        <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Periode</label>
                        <input type="month" name="period" id="period" value="{{ old('period', date('Y-m')) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('period')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Skor --}}
                    <div class="mb-4">
                        <label for="score" class="block text-sm font-medium text-gray-700 mb-1">Skor (0-100)</label>
                        <input type="number" name="score" id="score" value="{{ old('score') }}"
                            min="0" max="100" step="0.5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: 85">
                        <p class="text-xs text-gray-400 mt-1">≥90: Sangat Baik | ≥75: Baik | ≥60: Cukup | ≥50: Kurang | <50: Sangat Kurang</p>
                        @error('score')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan --}}
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Evaluasi</label>
                        <textarea name="notes" id="notes" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Berikan catatan evaluasi kinerja...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('kepala.evaluasi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">
                            Simpan Evaluasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
