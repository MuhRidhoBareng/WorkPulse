<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Laporan Kegiatan Yang Disetujui</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Filter --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-8 animate-fade-in-up anim-delay-1">
                <form method="GET" action="{{ route('kepala.laporan.index') }}" class="flex flex-wrap items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                        <select name="month" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="year" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @for($y = now()->year - 1; $y <= now()->year + 1; $y++)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium btn-pulse">
                        Tampilkan
                    </button>
                </form>
            </div>

            {{-- Tabel Laporan --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden animate-fade-in-up anim-delay-2">
                @if($reports->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pamong</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Kegiatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diverifikasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reports as $report)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $report->user->name }}</div>
                                            <div class="text-xs text-gray-500">NIP: {{ $report->user->nip }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $report->title }}</div>
                                            <div class="text-xs text-gray-500 max-w-xs truncate">{{ $report->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $report->activity_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                ✓ Disetujui
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $report->verifier?->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($report->document_path)
                                                <a href="{{ asset('storage/' . $report->document_path) }}" target="_blank"
                                                   class="text-blue-600 hover:text-blue-800 hover:underline text-sm font-medium">
                                                    Lihat Bukti
                                                </a>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4">
                        {{ $reports->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 mt-3">Belum ada laporan yang disetujui pada periode ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
