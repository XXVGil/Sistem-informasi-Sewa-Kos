<?php

namespace App\Http\Controllers;

use App\Models\Kos;

class KosController extends Controller
{
    public function show($id)
    {
        $kos = Kos::findOrFail($id);
        return view('user.kos.show', compact('kos'));
    }
}
