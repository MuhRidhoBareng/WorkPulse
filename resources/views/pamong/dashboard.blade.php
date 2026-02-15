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
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl animate-fade-in glass-alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Kehadiran Bulan Ini --}}
                <div class="card-premium p-6 animate-fade-in-up anim-delay-1">
                    <div class="stat-card stat-accent-blue">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg shadow-blue-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Kehadiran Bulan Ini</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $attendanceThisMonth }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Laporan --}}
                <div class="card-premium p-6 animate-fade-in-up anim-delay-2">
                    <div class="stat-card stat-accent-violet">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl p-3 shadow-lg shadow-violet-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalReports }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Menunggu Verifikasi --}}
                <div class="card-premium p-6 animate-fade-in-up anim-delay-3">
                    <div class="stat-card stat-accent-amber">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-3 shadow-lg shadow-amber-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $pendingReports }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Disetujui --}}
                <div class="card-premium p-6 animate-fade-in-up anim-delay-4">
                    <div class="stat-card stat-accent-emerald">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-3 shadow-lg shadow-emerald-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Disetujui</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $approvedReports }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Kehadiran Hari Ini --}}
            <div class="card-premium p-6 mb-8 animate-fade-in-up anim-delay-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Kehadiran Hari Ini — {{ now()->translatedFormat('l, d F Y') }}
                </h3>

                @if($todayAttendance)
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-lg">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-500">Clock In:</span>
                            <span class="font-bold text-emerald-600">{{ $todayAttendance->clock_in->format('H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-rose-50 px-4 py-2 rounded-lg">
                            <span class="text-sm text-gray-500">Clock Out:</span>
                            @if($todayAttendance->clock_out)
                                <span class="font-bold text-rose-600">{{ $todayAttendance->clock_out->format('H:i') }}</span>
                            @else
                                <span class="text-amber-600 italic font-medium">Belum clock out</span>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 mb-3">Anda belum melakukan clock in hari ini.</p>
                    <a href="{{ route('pamong.attendance.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl text-white text-sm font-semibold btn-premium shadow-lg">
                        Clock In Sekarang →
                    </a>
                @endif
            </div>

            {{-- Daftar Kegiatan dari TU --}}
            @if($activities->count() > 0)
                <div class="card-premium p-6 mb-8 animate-fade-in-up anim-delay-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        Kegiatan Bulan Ini
                    </h3>
                    <div class="space-y-3">
                        @foreach($activities as $activity)
                            <div class="border-l-4 border-blue-400 bg-gradient-to-r from-blue-50/60 to-transparent p-4 rounded-r-xl transition-all hover:from-blue-50">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <p class="font-semibold text-gray-800">{{ $activity->title }}</p>
                                        @if($activity->description)
                                            <p class="text-sm text-gray-600 mt-1">{{ $activity->description }}</p>
                                        @endif
                                        @if($activity->start_time || $activity->end_time)
                                            <p class="text-xs text-blue-600 mt-1.5 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                {{ $activity->start_time ? \Carbon\Carbon::parse($activity->start_time)->format('H:i') : '-' }}
                                                —
                                                {{ $activity->end_time ? \Carbon\Carbon::parse($activity->end_time)->format('H:i') : '-' }}
                                            </p>
                                        @endif
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full flex-shrink-0">
                                        {{ $activity->date->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Laporan Ditolak Terakhir --}}
            @if($recentRejected->count() > 0)
                <div class="card-premium p-6 animate-fade-in-up anim-delay-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        Laporan Ditolak
                    </h3>
                    <div class="space-y-3">
                        @foreach($recentRejected as $report)
                            <div class="border-l-4 border-rose-400 bg-gradient-to-r from-rose-50/60 to-transparent p-4 rounded-r-xl transition-all hover:from-rose-50">
                                <p class="font-medium text-gray-800">{{ $report->title }}</p>
                                <p class="text-sm text-rose-600 mt-1"><strong>Alasan:</strong> {{ $report->rejection_reason }}</p>
                                <p class="text-xs text-gray-500 mt-1">Ditolak oleh {{ $report->verifier?->name }} pada {{ $report->verified_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
