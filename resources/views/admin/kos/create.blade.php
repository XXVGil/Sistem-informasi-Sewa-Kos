@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Kos</h1>

<form action="{{ route('admin.kos.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf

    {{-- Nama Kos --}}
    <div>
        <label class="block font-semibold mb-1">Nama Kos</label>
        <input type="text" name="nama_kos"
               class="w-full border rounded px-3 py-2"
               placeholder="Contoh: Kos Mawar"
               required>
    </div>

    {{-- Kota --}}
    <div>
        <label class="block font-semibold mb-1">Kota</label>
        <select name="kota" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Kota --</option>
            <option value="Surabaya">Surabaya</option>
            <option value="Mojokerto">Mojokerto</option>
        </select>
    </div>

    {{-- Daerah --}}
    <div>
        <label class="block font-semibold mb-1">Daerah</label>
        <select name="daerah" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Daerah --</option>
            <option value="Ketintang">Ketintang</option>
            <option value="Empunala">Empunala</option>
            <option value="Mojopahit">Mojopahit</option>
        </select>
    </div>

    {{-- Kelas Kos --}}
    <div>
        <label class="block font-semibold mb-1">Kelas Kos</label>
        <select name="kelas_kos" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="Kelas 1">Kelas 1 (Wifi, AC, KM Dalam)</option>
            <option value="Kelas 2">Kelas 2 (Wifi, KM Dalam)</option>
            <option value="Kelas 3">Kelas 3 (Wifi, AC)</option>
        </select>
    </div>

    {{-- Alamat --}}
    <div>
        <label class="block font-semibold mb-1">Alamat Lengkap</label>
        <textarea name="alamat"
                  class="w-full border rounded px-3 py-2"
                  rows="2"
                  placeholder="Alamat lengkap kos"
                  required></textarea>
    </div>

    {{-- Harga --}}
    <div>
        <label class="block font-semibold mb-1">Harga / Bulan</label>
        <input type="number" name="harga_perbulan"
               class="w-full border rounded px-3 py-2"
               placeholder="Contoh: 500000"
               required>
    </div>

    {{-- Jenis Kos --}}
    <div>
        <label class="block font-semibold mb-1">Jenis Kos</label>
        <select name="jenis_kos" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="putra">Putra</option>
            <option value="putri">Putri</option>
            <option value="campur">Campur</option>
        </select>
    </div>

    {{-- Fasilitas --}}
    <div>
        <label class="block font-semibold mb-1">Fasilitas</label>
        <input type="text" name="fasilitas"
               class="w-full border rounded px-3 py-2"
               placeholder="Wifi, AC, Kamar Mandi Dalam"
               required>
        <p class="text-sm text-gray-500 mt-1">
            Pisahkan dengan koma (,)
        </p>
    </div>

    {{-- Deskripsi --}}
    <div>
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi"
                  class="w-full border rounded px-3 py-2"
                  rows="3"
                  placeholder="Deskripsi singkat kos (opsional)"></textarea>
    </div>

    {{-- Status --}}
    <div>
        <label class="block font-semibold mb-1">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2" required>
            <option value="tersedia">Tersedia</option>
            <option value="perbaikan">Perbaikan</option>
            <option value="disewa">Disewa</option>
        </select>
    </div>

    {{-- Upload Gambar --}}
    <div>
        <label class="block font-semibold mb-1">Gambar Kos</label>
        <input type="file"
               name="images[]"
               multiple
               class="w-full border rounded px-3 py-2">
        <p class="text-sm text-gray-500 mt-1">
            Bisa upload lebih dari satu gambar
        </p>
    </div>

    {{-- Tombol --}}
    <div class="flex gap-3 pt-4">
        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded">
            💾 Simpan Kos
        </button>

        <a href="{{ route('admin.kos.index') }}"
           class="bg-gray-500 text-white px-6 py-2 rounded">
            ⬅ Kembali
        </a>
    </div>

</form>
@endsection
    