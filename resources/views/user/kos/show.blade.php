@extends('user.layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- ================= LEFT : GAMBAR ================= --}}
    <div>
        @if($kos->images->count())
            {{-- Gambar utama --}}
            <img
                src="{{ asset('storage/' . $kos->images->first()->image) }}"
                class="w-full h-72 object-cover rounded-lg shadow mb-4">

            {{-- Thumbnail --}}
            @if($kos->images->count() > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($kos->images->skip(1) as $img)
                        <img
                            src="{{ asset('storage/' . $img->image) }}"
                            class="h-20 w-full object-cover rounded cursor-pointer hover:opacity-80">
                    @endforeach
                </div>
            @endif
        @else
            <div class="h-72 bg-gray-200 flex items-center justify-center rounded">
                <span class="text-gray-500">Tidak ada gambar</span>
            </div>
        @endif
    </div>

    {{-- ================= RIGHT : INFO ================= --}}
    <div>
        <h1 class="text-2xl font-bold text-red-600 mb-1">
            {{ $kos->nama_kos }}
        </h1>

        <p class="text-gray-500 mb-4">
            📍 {{ $kos->alamat }}
        </p>

        <div class="space-y-2 mb-6">
            <p><strong>Harga:</strong> Rp {{ number_format($kos->harga_perbulan,0,',','.') }} / bulan</p>
            <p><strong>Jenis:</strong> {{ ucfirst($kos->jenis_kos) }}</p>
            <p><strong>Fasilitas:</strong> {{ $kos->fasilitas }}</p>

            <span class="inline-block px-3 py-1 rounded text-sm
                {{ $kos->status === 'tersedia'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-gray-200 text-gray-600' }}">
                {{ ucfirst($kos->status) }}
            </span>
        </div>

        {{-- Booking --}}
        @if($kos->status !== 'tersedia')
            <div class="bg-gray-100 text-gray-500 p-3 rounded">
                Kos ini tidak bisa dibooking
            </div>
        @else
            @auth
                <a href="{{ route('booking.create', $kos->id) }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                    Booking Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                    Login untuk Booking
                </a>
            @endauth
        @endif
    </div>

</div>

{{-- ================= DESKRIPSI ================= --}}
<div class="mt-8 bg-white rounded shadow p-6">
    <h2 class="font-semibold mb-2">Deskripsi</h2>
    <p class="text-gray-700">
        {{ $kos->deskripsi ?? 'Tidak ada deskripsi.' }}
    </p>
</div>

@endsection
