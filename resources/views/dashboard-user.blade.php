@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard Akun</h1>
        <a href="{{ url('/') }}"
           class="text-sm text-blue-600 hover:underline">
            ⬅ Kembali ke Beranda
        </a>
    </div>

    {{-- INFO AKUN --}}
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold mb-4">Informasi Akun</h2>

        <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm">Nama</label>
                <input type="text" name="name"
                       value="{{ $user->name }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm">Email</label>
                <input type="email"
                       value="{{ $user->email }}"
                       disabled
                       class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block text-sm">No HP</label>
                <input type="text" name="no_hp"
                       value="{{ $user->no_hp }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm">Password Baru (opsional)</label>
                <input type="password" name="password"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded px-3 py-2">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- RIWAYAT BOOKING --}}
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold mb-4">Riwayat Booking</h2>

        @if($bookings->count())
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Kos</th>
                        <th class="p-2">Lama</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-t">
                            <td class="p-2">
                                {{ $booking->kos->nama_kos ?? '-' }}
                            </td>
                            <td class="p-2 text-center">
                                {{ $booking->lama_sewa }} bulan
                            </td>
                            <td class="p-2 text-center">
                                <span class="px-2 py-1 rounded text-xs
                                    {{ $booking->status === 'menunggu' ? 'bg-yellow-100 text-yellow-700' :
                                       ($booking->status === 'aktif' ? 'bg-green-100 text-green-700' :
                                        'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Belum ada booking.</p>
        @endif
    </div>

</div>
@endsection
