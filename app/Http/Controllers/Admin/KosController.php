<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KosImage; // ⬅️ TAMBAHAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    // 1️⃣ LIST DATA KOS
    public function index()
    {
        $kos = Kos::where('admin_id', Auth::guard('admin')->id())
                  ->latest()
                  ->get();

        return view('admin.kos.index', compact('kos'));
    }

    // 2️⃣ FORM TAMBAH KOS
    public function create()
    {
        return view('admin.kos.create');
    }

    // 3️⃣ SIMPAN KOS BARU + GAMBAR
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos'        => 'required',
            'kota'            => 'required',
            'daerah'          => 'required',
            'kelas_kos'       => 'required',
            'alamat'          => 'required',
            'harga_perbulan'  => 'required|numeric',
            'jenis_kos'       => 'required',
            'fasilitas'       => 'required',
            'deskripsi'       => 'nullable',
            'status'          => 'required',

            // ✅ VALIDASI GAMBAR (TAMBAHAN)
            'images.*'        => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔐 admin = pemilik kos
        $data['admin_id'] = Auth::guard('admin')->id();

        // ✅ SIMPAN DATA KOS
        $kos = Kos::create($data);

        // ✅ SIMPAN GAMBAR (JIKA ADA)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('kos', 'public');

                KosImage::create([
                    'kos_id' => $kos->id,
                    'image'  => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.kos.index')
            ->with('success', 'Kos berhasil ditambahkan');
    }

    // 4️⃣ FORM EDIT KOS
    public function edit($id)
    {
        $kos = Kos::where('admin_id', Auth::guard('admin')->id())
                  ->findOrFail($id);

        return view('admin.kos.edit', compact('kos'));
    }

    // 5️⃣ UPDATE KOS (TANPA GAMBAR – AMAN)
    public function update(Request $request, $id)
    {
        $kos = Kos::where('admin_id', Auth::guard('admin')->id())
                  ->findOrFail($id);

        $data = $request->validate([
            'nama_kos'        => 'required',
            'kota'            => 'required',
            'daerah'          => 'required',
            'kelas_kos'       => 'required',
            'alamat'          => 'required',
            'harga_perbulan'  => 'required|numeric',
            'jenis_kos'       => 'required',
            'fasilitas'       => 'required',
            'deskripsi'       => 'nullable',
            'status'          => 'required',
        ]);

        $kos->update($data);

        return redirect()
            ->route('admin.kos.index')
            ->with('success', 'Kos berhasil diperbarui');
    }

    // 6️⃣ HAPUS KOS
    public function destroy($id)
    {
        $kos = Kos::where('admin_id', Auth::guard('admin')->id())
                  ->findOrFail($id);

        $kos->delete();

        return redirect()
            ->route('admin.kos.index')
            ->with('success', 'Kos berhasil dihapus');
    }
}
