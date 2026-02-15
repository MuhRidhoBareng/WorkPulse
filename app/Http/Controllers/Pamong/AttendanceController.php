<?php

namespace App\Http\Controllers\Pamong;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $todayAttendance = Attendance::forUser($user->id)
            ->where('date', today())
            ->first();

        $attendances = Attendance::forUser($user->id)
            ->currentMonth()
            ->orderBy('date', 'desc')
            ->get();

        return view('pamong.attendance.index', compact('todayAttendance', 'attendances'));
    }

    public function clockIn(Request $request)
    {
        $user = auth()->user();

        // Cek apakah sudah clock in hari ini
        $existing = Attendance::forUser($user->id)
            ->where('date', today())
            ->first();

        if ($existing) {
            return back()->withErrors(['error' => 'Anda sudah melakukan clock in hari ini.']);
        }

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'photo.required' => 'Foto selfie wajib diunggah saat clock in.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $photoPath = $request->file('photo')->store('attendance-photos', 'public');

        Attendance::create([
            'user_id' => $user->id,
            'date' => today(),
            'clock_in' => now(),
            'latitude_in' => $request->latitude,
            'longitude_in' => $request->longitude,
            'clock_in_photo' => $photoPath,
            'status' => 'hadir',
        ]);

        return back()->with('success', 'Clock in berhasil dicatat!');
    }

    public function clockOut(Request $request)
    {
        $user = auth()->user();

        $attendance = Attendance::forUser($user->id)
            ->where('date', today())
            ->first();

        if (!$attendance) {
            return back()->withErrors(['error' => 'Anda belum melakukan clock in hari ini.']);
        }

        if ($attendance->hasClockOut()) {
            return back()->withErrors(['error' => 'Anda sudah melakukan clock out hari ini.']);
        }

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'photo.required' => 'Foto selfie wajib diunggah saat clock out.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $photoPath = $request->file('photo')->store('attendance-photos', 'public');

        $attendance->update([
            'clock_out' => now(),
            'latitude_out' => $request->latitude,
            'longitude_out' => $request->longitude,
            'clock_out_photo' => $photoPath,
        ]);

        return back()->with('success', 'Clock out berhasil dicatat!');
    }
}
