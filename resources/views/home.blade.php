@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-xl font-bold mb-4">Doubledoor – Sewa Kos</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($kos as $item)
            <div class="bg-white rounded shadow overflow-hidden">
                
                {{-- GAMBAR KOS --}}
                @if($item->images->count())
                    <img src="{{ asset('storage/' . $item->images->first()->image) }}"
                         class="w-full h-40 object-cover">
                @else
                    {{-- fallback kalau belum ada gambar --}}
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif

                {{-- ISI CARD --}}
                <div class="p-4">
                    <h5 class="font-semibold text-lg">
                        {{ $item->nama_kos }}
                    </h5>

                    <p class="text-sm text-gray-600">
                        {{ $item->alamat }}
                    </p>

                    <p class="font-bold mt-2">
                        Rp {{ number_format($item->harga_perbulan) }}/bulan
                    </p>
                </div>

            </div>
        @empty
            <p>Belum ada data kos.</p>
        @endforelse
    </div>
</div>
@endsection
