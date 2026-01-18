<?php

namespace App\Http\Controllers;

use App\Models\Kos;

class HomeController extends Controller
{
    public function index()
    {
        $kos = Kos::with('fotos')->get();
        return view('home', compact('kos'));
    }
}
