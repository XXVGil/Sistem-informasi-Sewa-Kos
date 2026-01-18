<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Doubledoor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">

{{-- NAVBAR --}}
<nav class="bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">
        <div class="font-bold text-xl">Doubledoor</div>

        <div class="space-x-6">
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="#filter" class="hover:underline">Cari Kos</a>
            <a href="/login" class="bg-white text-red-600 px-4 py-1 rounded">
                Login
            </a>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-8">
    @yield('content')
</main>

<footer class="bg-red-600 text-white text-center py-3">
    © {{ date('Y') }} Doubledoor
</footer>

</body>
</html>
