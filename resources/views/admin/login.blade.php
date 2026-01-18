<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Doubledoor</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="POST"
          action="{{ route('admin.login.post') }}"
          class="bg-white w-[360px] p-6 rounded-lg shadow">

        @csrf

        {{-- 🔙 TOMBOL KEMBALI (DI DALAM CARD) --}}
        <div class="mb-4">
            <a href="{{ route('user.dashboard') }}"
               class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                ⬅ Kembali ke Beranda
            </a>
        </div>

        <h2 class="text-xl font-bold mb-6 text-center">
            Login Admin
        </h2>

        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded">
            LOGIN
        </button>

        @if ($errors->any())
            <p class="text-red-600 text-sm mt-4 text-center">
                Email atau password salah
            </p>
        @endif
    </form>

</body>
</html>
