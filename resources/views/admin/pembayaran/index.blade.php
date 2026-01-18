@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pembayaran / Booking Masuk</h1>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white shadow rounded p-4 overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b text-left">
                <th class="py-2">User</th>
                <th>Kos</th>
                <th>Lama Sewa</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Bukti</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
                <tr class="border-b text-sm">
                    <td class="py-2">
                        {{ $booking->user->name ?? '-' }}
                    </td>

                    <td>
                        {{ $booking->kos->nama_kos ?? '-' }}
                    </td>

                    <td>
                        {{ $booking->lama_sewa }} bulan
                    </td>

                    <td>
                        Rp {{ number_format($booking->total_harga ?? 0,0,',','.') }}
                    </td>

                    <td class="capitalize">
                        {{ str_replace('_', ' ', $booking->metode_pembayaran) }}
                    </td>

                    {{-- BUKTI PEMBAYARAN --}}
                    <td>
                        @if($booking->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                               target="_blank"
                               class="text-blue-600 underline">
                                Lihat
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td>
                        <span class="px-2 py-1 text-xs rounded
                            {{ $booking->status === 'menunggu'
                                ? 'bg-yellow-100 text-yellow-700'
                                : ($booking->status === 'aktif'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
    @if($booking->status === 'menunggu')
        <div class="flex justify-center gap-2">

            {{-- APPROVE --}}
            <form method="POST"
                  action="{{ route('admin.pembayaran.approve', $booking->id) }}">
                @csrf
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                    ✔ Setujui
                </button>
            </form>

            {{-- REJECT --}}
            <form method="POST"
                  action="{{ route('admin.pembayaran.reject', $booking->id) }}">
                @csrf
                <button type="submit"
                        onclick="return confirm('Tolak booking ini?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                    ✖ Tolak
                </button>
            </form>

        </div>
    @else
        <span class="text-gray-400">-</span>
    @endif
</td>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-gray-500">
                        Belum ada booking masuk
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
