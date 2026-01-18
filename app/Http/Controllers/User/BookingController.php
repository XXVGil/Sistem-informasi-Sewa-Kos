<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * FORM BOOKING
     * user memilih lama sewa + metode pembayaran
     */
    public function create($kos_id)
    {
        $kos = Kos::findOrFail($kos_id);

        return view('user.booking.create', compact('kos'));
    }

    /**
     * SIMPAN BOOKING + BUKTI PEMBAYARAN
     */
    public function store(Request $request, $kos_id)
    {
        $request->validate([
            'lama_sewa' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,e_wallet,transfer_bank',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kos = Kos::findOrFail($kos_id);

        // hitung total harga
        $totalHarga = $kos->harga_perbulan * $request->lama_sewa;

        // upload bukti jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')
                ->store('bukti-pembayaran', 'public');
        }

        // simpan booking
        Booking::create([
            'user_id'           => Auth::id(),
            'kos_id'            => $kos->id,
            'lama_sewa'         => $request->lama_sewa,
            'total_harga'       => $totalHarga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran'  => $buktiPath,
            'status'            => 'menunggu',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Booking berhasil, menunggu konfirmasi pemilik kos');
    }
}
