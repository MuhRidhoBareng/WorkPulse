<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Dashboard Kepala SKB</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Statistik Overview --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card-premium p-6 animate-fade-in-up anim-delay-1">
                    <div class="stat-card stat-accent-blue">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg shadow-blue-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pamong Aktif</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalPamong }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-premium p-6 animate-fade-in-up anim-delay-2">
                    <div class="stat-card stat-accent-emerald">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-3 shadow-lg shadow-emerald-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Hadir Hari Ini</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $todayAttendance }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-premium p-6 animate-fade-in-up anim-delay-3">
                    <div class="stat-card stat-accent-amber">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-3 shadow-lg shadow-amber-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Laporan Pending</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $pendingReports }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-premium p-6 animate-fade-in-up anim-delay-4">
                    <div class="stat-card stat-accent-violet">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl p-3 shadow-lg shadow-violet-500/20">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Approved Bulan Ini</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $approvedThisMonth }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in-up anim-delay-5">
                <a href="{{ route('kepala.laporan.index') }}" class="card-premium p-6 group border border-transparent hover:border-blue-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-3 group-hover:scale-110 transition-all duration-300 shadow-sm">
                            <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Laporan ACC</h3>
                            <p class="text-sm text-gray-500">Lihat laporan kegiatan yang telah disetujui</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-blue-500 ml-auto transition-all group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </a>

                <a href="{{ route('kepala.rekap.index') }}" class="card-premium p-6 group border border-transparent hover:border-violet-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-violet-50 to-violet-100 rounded-xl p-3 group-hover:scale-110 transition-all duration-300 shadow-sm">
                            <svg class="h-8 w-8 text-violet-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-violet-600 transition-colors">Rekap Kinerja</h3>
                            <p class="text-sm text-gray-500">Lihat rekapitulasi kehadiran & kegiatan per Pamong</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-violet-500 ml-auto transition-all group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
