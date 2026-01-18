<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pencari Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

{{-- NAVBAR --}}
<nav class="bg-red-600 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">🇮🇩 Sistem Informasi Sewa Kos</h1>

    <div class="flex items-center gap-3">
        <a href="{{ route('user.dashboard') }}" class="hover:underline">
            Dashboard
        </a>

        @auth
            <a href="{{ route('dashboard') }}"
               class="bg-white text-red-600 px-3 py-1 rounded font-semibold">
                Akun Saya
            </a>
        @else
            <a href="{{ route('login') }}"
               class="bg-white text-red-600 px-3 py-1 rounded font-semibold">
                Login User
            </a>
        @endauth

        <a href="{{ route('admin.login') }}"
           class="border border-white px-3 py-1 rounded hover:bg-white hover:text-red-600 transition">
            Login Pemilik Kos
        </a>
    </div>
</nav>

{{-- CONTENT --}}
<div class="max-w-7xl mx-auto px-6 py-8">

    <h2 class="text-2xl font-bold text-red-700 mb-6">
        Daftar Kos Tersedia
    </h2>

    {{-- FILTER (placeholder TA) --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" placeholder="Kota"
                   class="border rounded px-3 py-2">

            <select class="border rounded px-3 py-2">
                <option>Pilih Kelas Kos</option>
                <option>Kelas 1</option>
                <option>Kelas 2</option>
                <option>Kelas 3</option>
            </select>

            <input type="number" placeholder="Harga Maksimal"
                   class="border rounded px-3 py-2">

            <button class="bg-red-600 text-white rounded px-4 py-2 hover:bg-red-700">
                Filter
            </button>
        </form>
    </div>

    {{-- LIST KOS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($kos as $item)
            <div class="bg-white rounded shadow overflow-hidden">

                {{-- GAMBAR --}}
                <img
                    src="{{ $item->images->first()
                        ? asset('storage/' . $item->images->first()->image)
                        : asset('images/no-image.png') }}"
                    class="w-full h-48 object-cover">

                <div class="p-4 space-y-2">
                    <h3 class="font-bold text-lg text-red-600">
                        {{ $item->nama_kos }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        📍 {{ $item->alamat }}
                    </p>

                    <p class="font-semibold">
                        💰 Rp {{ number_format($item->harga_perbulan) }} / bulan
                    </p>

                    <p class="text-sm">
                        🏠 {{ ucfirst($item->jenis_kos) }}
                    </p>

                    <span class="inline-block px-2 py-1 text-xs rounded
                        {{ $item->status === 'tersedia'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-gray-200 text-gray-600' }}">
                        {{ ucfirst($item->status) }}
                    </span>

                    <a href="{{ route('kos.detail', $item->id) }}"
                       class="block text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 mt-3">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">
                Tidak ada kos tersedia.
            </p>
        @endforelse
    </div>
</div>

{{-- FOOTER --}}
<footer class="mt-10 text-center text-sm text-gray-500 py-4">
    © {{ date('Y') }} Sistem Informasi Sewa Kos |
    <a href="{{ route('admin.login') }}" class="underline">
        Pemilik Kos
    </a>
</footer>

</body>
</html>
