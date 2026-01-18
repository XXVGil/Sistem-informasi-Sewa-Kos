@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Kos</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border-collapse bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3 border">Nama Kos</th>
            <th class="p-3 border">Alamat</th>
            <th class="p-3 border">Harga</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kos as $item)
        <tr class="text-center">
            <td class="p-3 border">{{ $item->nama_kos }}</td>
            <td class="p-3 border">{{ $item->alamat }}</td>
            <td class="p-3 border">Rp {{ number_format($item->harga_perbulan) }}</td>
            <td class="p-3 border">{{ ucfirst($item->status) }}</td>
            <td class="p-3 border space-x-2">

                {{-- EDIT --}}
                <a href="{{ route('admin.kos.edit', $item->id) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                   ✏️ Edit
                </a>

                {{-- HAPUS --}}
                <form action="{{ route('admin.kos.destroy', $item->id) }}"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('Yakin hapus kos ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        🗑️ Hapus
                    </button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                Belum ada data kos
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
