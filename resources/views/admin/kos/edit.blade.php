@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Kos</h1>

<form action="{{ route('admin.kos.update', $kos->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    {{-- NAMA KOS --}}
    <div>
        <label class="block font-semibold">Nama Kos</label>
        <input type="text" name="nama_kos"
               value="{{ old('nama_kos', $kos->nama_kos) }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    {{-- ALAMAT --}}
    <div>
        <label class="block font-semibold">Alamat</label>
        <input type="text" name="alamat"
               value="{{ old('alamat', $kos->alamat) }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    {{-- HARGA --}}
    <div>
        <label class="block font-semibold">Harga / Bulan</label>
        <input type="number" name="harga_perbulan"
               value="{{ old('harga_perbulan', $kos->harga_perbulan) }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    {{-- JENIS --}}
    <div>
        <label class="block font-semibold">Jenis Kos</label>
        <select name="jenis_kos" class="w-full border rounded px-3 py-2">
            <option value="putra" {{ $kos->jenis_kos == 'putra' ? 'selected' : '' }}>Putra</option>
            <option value="putri" {{ $kos->jenis_kos == 'putri' ? 'selected' : '' }}>Putri</option>
            <option value="campur" {{ $kos->jenis_kos == 'campur' ? 'selected' : '' }}>Campur</option>
        </select>
    </div>

    {{-- FASILITAS --}}
    <div>
        <label class="block font-semibold">Fasilitas</label>
        <input type="text" name="fasilitas"
               value="{{ old('fasilitas', $kos->fasilitas) }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    {{-- DESKRIPSI --}}
    <div>
        <label class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi"
                  class="w-full border rounded px-3 py-2"
                  rows="3">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
    </div>

    {{-- STATUS --}}
    <div>
        <label class="block font-semibold">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2">
            <option value="tersedia" {{ $kos->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="disewa" {{ $kos->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
            <option value="perbaikan" {{ $kos->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
        </select>
    </div>

    {{-- ================= GAMBAR ================= --}}

    {{-- TAMBAH GAMBAR BARU --}}
    <div>
        <label class="block font-semibold mb-1">Tambah Gambar Baru</label>
        <input type="file"
               name="images[]"
               multiple
               class="w-full border rounded px-3 py-2">
        <small class="text-gray-500">Bisa upload lebih dari satu gambar</small>
    </div>

    {{-- GAMBAR LAMA --}}
    @if($kos->images->count())
        <div>
            <label class="block font-semibold mb-2">Gambar Saat Ini</label>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($kos->images as $img)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $img->image) }}"
                             class="w-full h-32 object-cover rounded shadow">

                        <form method="POST"
                              action="{{ route('admin.kos.image.destroy', $img->id) }}"
                              class="absolute top-1 right-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus gambar ini?')"
                                    class="bg-red-600 text-white text-xs px-2 py-1 rounded">
                                ✕
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ================= BUTTON ================= --}}
    <div class="flex gap-3 pt-4">
        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded">
            💾 Update
        </button>

        <a href="{{ route('admin.kos.index') }}"
           class="bg-gray-500 text-white px-5 py-2 rounded">
            ⬅ Kembali
        </a>
    </div>

</form>
@endsection
