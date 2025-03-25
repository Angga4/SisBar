<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.guru'); 
    }

    public function barang()
    {
        $barang = Barang::all();
        return view('guru.barang', compact('barang'));
    }

}
