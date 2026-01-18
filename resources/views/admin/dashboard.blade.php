@extends('admin.layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800">
    Dashboard Admin
</h1>

<div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Kos Tersedia</h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $kosTersedia }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Kos Disewa</h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $kosDisewa }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Kos Perbaikan</h3>
        <p class="text-3xl font-bold text-yellow-500">
            {{ $kosPerbaikan }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
        <h3 class="text-gray-500">Booking Menunggu</h3>
        <p class="text-3xl font-bold text-red-600">
            {{ $bookingMenunggu }}
        </p>
    </div>

</div>
@endsection
