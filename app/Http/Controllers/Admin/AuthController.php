<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // 🔥 PASTI PAKAI GUARD ADMIN
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // Login berhasil → ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 🔥 LANGSUNG KE HALAMAN UTAMA (HOMEPAGE)
    return redirect('/')
        ->with('success', 'Berhasil logout sebagai pemilik kos');
}
}
