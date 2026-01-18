@extends('user.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold text-red-600 mb-6">
        Form Booking Kos
    </h1>

    {{-- INFO KOS --}}
    <div class="bg-gray-50 border rounded p-4 mb-6">
        <p class="font-semibold">{{ $kos->nama_kos }}</p>
        <p class="text-sm text-gray-600">📍 {{ $kos->alamat }}</p>
        <p class="text-sm">💰 Rp {{ number_format($kos->harga_perbulan,0,',','.') }} / bulan</p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('booking.store', $kos->id) }}"
          enctype="multipart/form-data"
          class="space-y-5">
        @csrf

        {{-- Nama Penyewa --}}
        <div>
            <label class="block mb-1 font-semibold">Nama Penyewa</label>
            <input type="text"
                   name="nama_penyewa"
                   required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-200">
        </div>

        {{-- No HP --}}
        <div>
            <label class="block mb-1 font-semibold">No HP</label>
            <input type="text"
                   name="no_hp"
                   required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-200">
        </div>

        {{-- Lama Sewa --}}
        <div>
            <label class="block mb-1 font-semibold">Lama Sewa (bulan)</label>
            <input type="number"
                   name="lama_sewa"
                   min="1"
                   required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-200">
        </div>

        {{-- Metode Pembayaran --}}
        <div>
            <label class="block mb-1 font-semibold">Metode Pembayaran</label>
            <select name="metode_pembayaran"
                    required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-200">
                <option value="">Pilih Metode</option>
                <option value="tunai">Tunai</option>
                <option value="e_wallet">E-Wallet</option>
                <option value="transfer_bank">Transfer Bank</option>
            </select>
        </div>

        {{-- Bukti Pembayaran --}}
        <div>
            <label class="block mb-1 font-semibold">
                Bukti Pembayaran <span class="text-sm text-gray-500">(opsional)</span>
            </label>
            <input type="file"
                   name="bukti_pembayaran"
                   accept="image/png,image/jpeg"
                   class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">JPG / PNG, max 2MB</p>
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                Kirim Booking
            </button>

            <a href="{{ route('kos.detail', $kos->id) }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
