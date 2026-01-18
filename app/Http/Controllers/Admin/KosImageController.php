<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KosImage;
use Illuminate\Support\Facades\Storage;

class KosImageController extends Controller
{
    public function destroy(KosImage $image)
    {
        // hapus file fisik
        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        // hapus data DB
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
