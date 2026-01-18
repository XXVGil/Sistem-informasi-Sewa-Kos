<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * =====================================================
     * HALAMAN 0 / LANDING PAGE
     * URL: /
     * =====================================================
     */
    public function index(Request $request)
    {
        $kos = Kos::where('status', 'tersedia')
            ->when($request->kota, fn ($q) =>
                $q->where('kota', $request->kota)
            )
            ->when($request->kelas_kos, fn ($q) =>
                $q->where('kelas_kos', $request->kelas_kos)
            )
            ->when($request->fasilitas, fn ($q) =>
                $q->where('fasilitas', 'like', '%' . $request->fasilitas . '%')
            )
            ->when($request->harga_max, fn ($q) =>
                $q->where('harga_perbulan', '<=', $request->harga_max)
            )
            ->latest()
            ->get();

        return view('user.dashboard', compact('kos'));
    }

    /**
     * =====================================================
     * DASHBOARD USER (SETELAH LOGIN)
     * URL: /dashboard
     * =====================================================
     */
    public function userDashboard()
    {
        $user = Auth::user();

        $bookings = Booking::with('kos')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard-user', compact('user', 'bookings'));
    }

    /**
     * =====================================================
     * UPDATE PROFIL USER
     * =====================================================
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'no_hp'    => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name  = $request->name;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
