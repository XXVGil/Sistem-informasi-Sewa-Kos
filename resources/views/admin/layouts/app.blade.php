<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

  <!-- SIDEBAR -->
<aside class="w-64 bg-gray-800 text-white flex-shrink-0 flex flex-col">

    <!-- LOGO -->
    <div class="p-5 text-xl font-bold border-b border-gray-700 text-center">
        🏠 Doubledoor Admin
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-6 py-8 space-y-3">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-700' }}">
            📊 <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.kos.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('admin.kos.index') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-700' }}">
            🏠 <span>Data Kos</span>
        </a>

        <a href="{{ route('admin.kos.create') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('admin.kos.create') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-700' }}">
            ➕ <span>Tambah Kos</span>
        </a>

        <a href="{{ route('admin.pembayaran.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('admin.pembayaran.*') ? 'bg-gray-700 font-semibold' : 'hover:bg-gray-700' }}">
            💳 <span>Pembayaran</span>
        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="px-6 pb-6">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600 transition">
                🚪 <span>Logout</span>
            </button>
        </form>
    </div>

</aside>

    <!-- CONTENT -->
    <main class="flex-1 px-10 py-8">
        <div class="max-w-5xl mx-auto">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
