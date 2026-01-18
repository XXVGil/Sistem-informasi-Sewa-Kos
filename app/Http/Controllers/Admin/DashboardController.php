<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung status kos
        $kosTersedia = Kos::where('status', 'tersedia')->count();
        $kosDisewa = Kos::where('status', 'disewa')->count();
        $kosPerbaikan = Kos::where('status', 'perbaikan')->count();

        // 🔥 Total booking menunggu konfirmasi
        $bookingMenunggu = Booking::where('status', 'menunggu')->count();

        return view('admin.dashboard', compact(
            'kosTersedia',
            'kosDisewa',
            'kosPerbaikan',
            'bookingMenunggu'
        ));
    }
}
