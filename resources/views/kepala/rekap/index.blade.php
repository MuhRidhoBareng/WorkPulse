<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Rekap Kinerja Pamong</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Filter & Export --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-8 animate-fade-in-up anim-delay-1">
                <form method="GET" action="{{ route('kepala.rekap.index') }}" class="flex flex-wrap items-end gap-4">
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

                    {{-- Export Excel Button --}}
                    <a href="{{ route('kepala.rekap.export', ['month' => $month, 'year' => $year]) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium gap-2 ml-auto">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export Excel
                    </a>
                </form>
            </div>

            {{-- Tabel Rekap --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden animate-fade-in-up anim-delay-2">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pamong</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kehadiran</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Target</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">%</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kegiatan Approved</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Target</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">%</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Pending</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($rekap as $r)
                                @php
                                    $attPercent = $r->target_attendance > 0 ? round(($r->total_attendance / $r->target_attendance) * 100) : 0;
                                    $actPercent = $r->target_activities > 0 ? round(($r->total_activities / $r->target_activities) * 100) : 0;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $r->pamong->name }}</div>
                                        <div class="text-xs text-gray-500">NIP: {{ $r->pamong->nip }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-900">{{ $r->total_attendance }}</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $r->target_attendance }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $attPercent >= 80 ? 'bg-green-100 text-green-800' : ($attPercent >= 50 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $attPercent }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-900">{{ $r->total_activities }}</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $r->target_activities }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $actPercent >= 80 ? 'bg-green-100 text-green-800' : ($actPercent >= 50 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $actPercent }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        @if($r->pending_activities > 0)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $r->pending_activities }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">0</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
