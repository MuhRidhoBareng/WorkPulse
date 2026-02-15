<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">
            Dashboard Pamong
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Kehadiran Bulan Ini --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-1 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Kehadiran Bulan Ini</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $attendanceThisMonth }}</p>
                        </div>
                    </div>
                </div>

                {{-- Total Laporan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-2 border-l-4 border-indigo-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalReports }}</p>
                        </div>
                    </div>
                </div>

                {{-- Menunggu Verifikasi --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-3 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pendingReports }}</p>
                        </div>
                    </div>
                </div>

                {{-- Disetujui --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-4 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Disetujui</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $approvedReports }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Kehadiran Hari Ini --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8 animate-fade-in-up anim-delay-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Kehadiran Hari Ini — {{ now()->translatedFormat('l, d F Y') }}</h3>

                @if($todayAttendance)
                    <div class="flex items-center gap-6">
                        <div>
                            <span class="text-sm text-gray-500">Clock In:</span>
                            <span class="ml-2 font-semibold text-green-600">{{ $todayAttendance->clock_in->format('H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Clock Out:</span>
                            @if($todayAttendance->clock_out)
                                <span class="ml-2 font-semibold text-red-600">{{ $todayAttendance->clock_out->format('H:i') }}</span>
                            @else
                                <span class="ml-2 text-yellow-600 italic">Belum clock out</span>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Anda belum melakukan clock in hari ini.</p>
                    <a href="{{ route('pamong.attendance.index') }}" class="mt-2 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm btn-pulse">
                        Clock In Sekarang →
                    </a>
                @endif
            </div>

            {{-- Laporan Ditolak Terakhir --}}
            @if($recentRejected->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 animate-fade-in-up anim-delay-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <span class="text-red-600">⚠</span> Laporan Ditolak
                    </h3>
                    <div class="space-y-3">
                        @foreach($recentRejected as $report)
                            <div class="border-l-4 border-red-400 bg-red-50 p-4 rounded-r-lg card-hover">
                                <p class="font-medium text-gray-800">{{ $report->title }}</p>
                                <p class="text-sm text-red-600 mt-1"><strong>Alasan:</strong> {{ $report->rejection_reason }}</p>
                                <p class="text-xs text-gray-500 mt-1">Ditolak oleh {{ $report->verifier?->name }} pada {{ $report->verified_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
