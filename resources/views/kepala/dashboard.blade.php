<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Dashboard Kepala SKB</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Statistik Overview --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-1 border-l-4 border-indigo-500">
                    <div class="text-sm font-medium text-gray-500">Total Pamong Aktif</div>
                    <div class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalPamong }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-2 border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500">Hadir Hari Ini</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">{{ $todayAttendance }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-3 border-l-4 border-yellow-500">
                    <div class="text-sm font-medium text-gray-500">Laporan Pending</div>
                    <div class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingReports }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-4 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500">Approved Bulan Ini</div>
                    <div class="text-3xl font-bold text-blue-600 mt-2">{{ $approvedThisMonth }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 card-hover animate-fade-in-up anim-delay-5 border-l-4 border-purple-500">
                    <div class="text-sm font-medium text-gray-500">Evaluasi Bulan Ini</div>
                    <div class="text-3xl font-bold text-purple-600 mt-2">{{ $reviewsThisMonth }}</div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in-up anim-delay-6">
                <a href="{{ route('kepala.rekap.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 card-hover group border border-transparent hover:border-indigo-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3 group-hover:bg-indigo-200 group-hover:scale-110 transition-all duration-300">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors">Rekap Kinerja</h3>
                            <p class="text-sm text-gray-500">Lihat rekapitulasi kehadiran & kegiatan per Pamong</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('kepala.evaluasi.create') }}" class="bg-white shadow-sm sm:rounded-lg p-6 card-hover group border border-transparent hover:border-purple-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3 group-hover:bg-purple-200 group-hover:scale-110 transition-all duration-300">
                            <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-purple-600 transition-colors">Beri Evaluasi</h3>
                            <p class="text-sm text-gray-500">Berikan penilaian kinerja untuk Pamong</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
