<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countPelanggan = Pelanggan::count();
        $countObat = Obat::count();
        $countPenjualan = Penjualan::count();
        $obat = Obat::orderBy('id', 'desc')->paginate(5);
        return view('dashboard', compact('countPelanggan', 'countObat', 'countPenjualan', 'obat'));
    }

}
