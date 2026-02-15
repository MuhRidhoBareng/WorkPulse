<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate-slide-in-left">Kehadiran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Clock In / Clock Out Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8 animate-fade-in-up anim-delay-1">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ now()->translatedFormat('l, d F Y') }}</h3>

                @if(!$todayAttendance)
                    {{-- Belum clock in --}}
                    <form id="clockInForm" method="POST" action="{{ route('pamong.attendance.clockIn') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="latitude" id="lat_in">
                        <input type="hidden" name="longitude" id="lng_in">

                        {{-- Upload Foto --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">📸 Foto Selfie Clock In <span class="text-red-500">*</span></label>

                            {{-- Preview foto --}}
                            <div id="preview_in_container" class="hidden mb-3">
                                <img id="preview_in" class="h-40 w-40 object-cover rounded-lg border-2 border-green-300">
                            </div>

                            <input type="file" name="photo" id="photo_in" accept="image/jpg,image/jpeg,image/png" capture="user"
                                onchange="previewImage(this, 'preview_in', 'preview_in_container')"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            <p class="text-xs text-gray-400 mt-1">Ambil foto selfie sebagai bukti kehadiran. Format: JPG, JPEG, PNG. Maks 2MB.</p>
                            @error('photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="button" onclick="submitWithLocation('in')" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition btn-pulse">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            Clock In
                        </button>
                    </form>
                @elseif(!$todayAttendance->hasClockOut())
                    {{-- Sudah clock in, belum clock out --}}
                    <div class="mb-4">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                                <span class="text-sm text-gray-500">Clock In:</span>
                                <span class="ml-1 font-bold text-green-700">{{ $todayAttendance->clock_in->format('H:i:s') }}</span>
                            </div>
                            @if($todayAttendance->clock_in_photo)
                                <a href="{{ asset('storage/' . $todayAttendance->clock_in_photo) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">📷 Lihat foto clock in</a>
                            @endif
                        </div>

                        <form id="clockOutForm" method="POST" action="{{ route('pamong.attendance.clockOut') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="latitude" id="lat_out">
                            <input type="hidden" name="longitude" id="lng_out">

                            {{-- Upload Foto --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">📸 Foto Selfie Clock Out <span class="text-red-500">*</span></label>

                                <div id="preview_out_container" class="hidden mb-3">
                                    <img id="preview_out" class="h-40 w-40 object-cover rounded-lg border-2 border-red-300">
                                </div>

                                <input type="file" name="photo" id="photo_out" accept="image/jpg,image/jpeg,image/png" capture="user"
                                    onchange="previewImage(this, 'preview_out', 'preview_out_container')"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                <p class="text-xs text-gray-400 mt-1">Ambil foto selfie sebagai bukti pulang. Format: JPG, JPEG, PNG. Maks 2MB.</p>
                                @error('photo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="button" onclick="submitWithLocation('out')" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition btn-pulse">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                Clock Out
                            </button>
                        </form>
                    </div>
                @else
                    {{-- Sudah clock in dan clock out --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                                <span class="text-sm text-gray-500">Clock In:</span>
                                <span class="ml-1 font-bold text-green-700">{{ $todayAttendance->clock_in->format('H:i:s') }}</span>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-2">
                                <span class="text-sm text-gray-500">Clock Out:</span>
                                <span class="ml-1 font-bold text-red-700">{{ $todayAttendance->clock_out->format('H:i:s') }}</span>
                            </div>
                            <span class="text-sm text-gray-500 italic">✅ Kehadiran hari ini sudah selesai</span>
                        </div>
                        {{-- Foto bukti --}}
                        <div class="flex gap-4">
                            @if($todayAttendance->clock_in_photo)
                                <a href="{{ asset('storage/' . $todayAttendance->clock_in_photo) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">📷 Foto Clock In</a>
                            @endif
                            @if($todayAttendance->clock_out_photo)
                                <a href="{{ asset('storage/' . $todayAttendance->clock_out_photo) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">📷 Foto Clock Out</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Riwayat Kehadiran Bulan Ini --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 animate-fade-in-up anim-delay-3">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Kehadiran — {{ now()->translatedFormat('F Y') }}</h3>

                @if($attendances->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clock In</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clock Out</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendances as $att)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $att->date->translatedFormat('l, d F Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">{{ $att->clock_in->format('H:i:s') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $att->clock_out ? 'text-red-600 font-medium' : 'text-gray-400 italic' }}">
                                            {{ $att->clock_out ? $att->clock_out->format('H:i:s') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex gap-2">
                                                @if($att->clock_in_photo)
                                                    <a href="{{ asset('storage/' . $att->clock_in_photo) }}" target="_blank" class="text-indigo-600 hover:underline text-xs">📷 In</a>
                                                @endif
                                                @if($att->clock_out_photo)
                                                    <a href="{{ asset('storage/' . $att->clock_out_photo) }}" target="_blank" class="text-indigo-600 hover:underline text-xs">📷 Out</a>
                                                @endif
                                                @if(!$att->clock_in_photo && !$att->clock_out_photo)
                                                    <span class="text-gray-400 text-xs italic">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($att->status === 'hadir') bg-green-100 text-green-800
                                                @elseif($att->status === 'izin') bg-blue-100 text-blue-800
                                                @elseif($att->status === 'sakit') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ $att->status_label }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada data kehadiran bulan ini.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function previewImage(input, previewId, containerId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(containerId).classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function submitWithLocation(type) {
            event.preventDefault();
            const form = type === 'in' ? document.getElementById('clockInForm') : document.getElementById('clockOutForm');
            const latField = document.getElementById('lat_' + type);
            const lngField = document.getElementById('lng_' + type);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        latField.value = position.coords.latitude;
                        lngField.value = position.coords.longitude;
                        form.submit();
                    },
                    function(error) {
                        // GPS ditolak atau tidak tersedia — tetap bisa clock in/out
                        console.log('GPS tidak tersedia:', error.message);
                        latField.value = '';
                        lngField.value = '';
                        form.submit();
                    },
                    { timeout: 5000, enableHighAccuracy: true }
                );
            } else {
                // Browser tidak support geolocation
                form.submit();
            }
        }
    </script>
</x-app-layout>
