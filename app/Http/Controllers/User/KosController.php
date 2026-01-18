<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;

class KosController extends Controller
{
    public function show(Kos $kos)
    {
        // eager load images
        $kos->load('images');

        return view('user.kos.show', compact('kos'));
    }
}
