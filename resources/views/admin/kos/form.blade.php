<div class="mb-4">
    <label>Nama Kos</label>
    <input name="nama_kos" class="w-full border p-2"
           value="{{ $kos->nama_kos ?? '' }}">
</div>

<div class="mb-4">
    <label>Alamat</label>
    <textarea name="alamat" class="w-full border p-2">{{ $kos->alamat ?? '' }}</textarea>
</div>

<div class="mb-4">
    <label>Harga / Bulan</label>
    <input type="number" name="harga_perbulan"
           class="w-full border p-2"
           value="{{ $kos->harga_perbulan ?? '' }}">
</div>

<div class="mb-4">
    <label>Jenis Kos</label>
    <select name="jenis_kos" class="w-full border p-2">
        @foreach(['putra','putri','campur'] as $j)
        <option value="{{ $j }}"
            @selected(($kos->jenis_kos ?? '')==$j)>
            {{ ucfirst($j) }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Fasilitas</label>
    <textarea name="fasilitas" class="w-full border p-2">{{ $kos->fasilitas ?? '' }}</textarea>
</div>

<div class="mb-4">
    <label>Status</label>
    <select name="status" class="w-full border p-2">
        @foreach(['tersedia','disewa','perbaikan'] as $s)
        <option value="{{ $s }}"
            @selected(($kos->status ?? '')==$s)>
            {{ ucfirst($s) }}
        </option>
        @endforeach
    </select>
</div>
