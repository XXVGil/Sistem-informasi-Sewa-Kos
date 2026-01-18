<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kos;

class PembayaranController extends Controller
{
    // LIST BOOKING MASUK
    public function index()
    {
        $bookings = Booking::with('kos', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('bookings'));
    }

    // SETUJUI BOOKING
    public function approve(Booking $booking)
    {
        $booking->update([
            'status' => 'aktif'
        ]);

        // ubah status kos jadi disewa
        $booking->kos->update([
            'status' => 'disewa'
        ]);

        return back()->with('success', 'Booking disetujui');
    }

    // TOLAK BOOKING
    public function reject(Booking $booking)
    {
        $booking->update([
            'status' => 'batal'
        ]);

        return back()->with('success', 'Booking ditolak');
    }
}
