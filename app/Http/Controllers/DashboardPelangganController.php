<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class DashboardPelangganController extends Controller
{
    public function index()
    {
        $obat = Obat::orderBy('id', 'desc')->paginate(5);
        return view('dashboard_pelanggan', compact('obat'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // return $searchTerm;

        $obat = Obat::where('NmObat', 'like', '%' . $searchTerm . '%')->get();

        return view('dashboard_pelanggan', compact('obat'));
    }
}
