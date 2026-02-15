<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Laporan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-{{ $report->status_color }}-100 text-{{ $report->status_color }}-800">
                        {{ $report->status_label }}
                    </span>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $report->title }}</h3>
                <p class="text-sm text-gray-500 mb-6">Tanggal Kegiatan: {{ $report->activity_date->format('d F Y') }}</p>

                <div class="prose max-w-none mb-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Deskripsi</h4>
                    <p class="text-gray-800 whitespace-pre-wrap">{{ $report->description }}</p>
                </div>

                @if($report->document_path)
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Dokumen Bukti</h4>
                        <a href="{{ Storage::url($report->document_path) }}" target="_blank"
                            class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
                            <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                            </svg>
                            Lihat Dokumen
                        </a>
                    </div>
                @endif

                @if($report->isRejected() && $report->rejection_reason)
                    <div class="border-l-4 border-red-400 bg-red-50 p-4 rounded-r-lg mb-6">
                        <h4 class="text-sm font-medium text-red-800 mb-1">Alasan Penolakan</h4>
                        <p class="text-red-700">{{ $report->rejection_reason }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            Ditolak oleh {{ $report->verifier?->name }} pada {{ $report->verified_at?->format('d/m/Y H:i') }}
                        </p>
                    </div>
                @endif

                @if($report->isApproved())
                    <div class="border-l-4 border-green-400 bg-green-50 p-4 rounded-r-lg mb-6">
                        <p class="text-green-700">
                            ✅ Disetujui oleh {{ $report->verifier?->name }} pada {{ $report->verified_at?->format('d/m/Y H:i') }}
                        </p>
                    </div>
                @endif

                <div class="mt-6 pt-4 border-t">
                    <a href="{{ route('pamong.reports.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                        ← Kembali ke daftar laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
