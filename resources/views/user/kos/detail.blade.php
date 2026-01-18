<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

{{-- NAVBAR --}}
<nav class="bg-red-600 text-white px-6 py-4 flex justify-between items-center">
    <a href="{{ route('user.dashboard') }}" class="font-bold hover:underline">
        ⬅ Kembali
    </a>
    <a href="{{ route('admin.login') }}" class="underline">
        Pemilik Kos
    </a>
</nav>

{{-- CONTENT --}}
<div class="max-w-4xl mx-auto mt-6 bg-white p-5 rounded shadow">

    {{-- JUDUL --}}
    <h1 class="text-xl font-bold text-red-600">
        {{ $kos->nama_kos }}
    </h1>

    <p class="text-gray-600 text-sm mb-3">
        📍 {{ $kos->alamat }}
    </p>

    {{-- GAMBAR UTAMA --}}
@if($kos->images->count())
    <div
        class="w-full h-[200px] rounded-lg mb-4 bg-center bg-cover">
        <div
            class="w-full h-full rounded-lg"
            style="background-image: url('{{ asset('storage/' . $kos->images->first()->image) }}')">
        </div>
    </div>
@endif

    {{-- INFO RINGKAS --}}
    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
        <div>
            <p><strong>Harga:</strong></p>
            <p class="text-red-600 font-semibold">
                Rp {{ number_format($kos->harga_perbulan, 0, ',', '.') }} / bulan
            </p>
        </div>

        <div>
            <p><strong>Status:</strong></p>
            <span class="inline-block px-2 py-1 rounded text-xs
                {{ $kos->status === 'tersedia'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-gray-200 text-gray-600' }}">
                {{ ucfirst($kos->status) }}
            </span>
        </div>
    </div>

    {{-- DETAIL --}}
    <div class="text-sm space-y-1 mb-4">
        <p><strong>Jenis Kos:</strong> {{ ucfirst($kos->jenis_kos) }}</p>
        <p><strong>Fasilitas:</strong> {{ $kos->fasilitas }}</p>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-6">
        <h2 class="font-semibold mb-1 text-sm">Deskripsi</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            {{ $kos->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>
    </div>

    {{-- BOOKING --}}
    <div>
        @if($kos->status !== 'tersedia')
            <div class="bg-gray-100 text-gray-500 p-3 rounded text-sm">
                Kos ini tidak bisa dibooking saat ini.
            </div>
        @else
            @auth
                <a href="{{ route('booking.create', $kos->id) }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded text-sm">
                    Booking Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded text-sm">
                    Login untuk Booking
                </a>
            @endauth
        @endif
    </div>

</div>

<footer class="mt-8 text-center text-xs text-gray-500 py-4">
    © {{ date('Y') }} Sistem Informasi Sewa Kos
</footer>

</body>
</html>
