<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Penjualan_detail;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->get();
        return view('penjualan.index', compact('penjualan'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $penjualan = Penjualan::where('TglNota', 'like', '%' . $searchTerm . '%')->get();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::get();
        return view('penjualan.create', compact('pelanggan'));
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'tgl_nota' => 'required',
            'pelanggan_id' => 'required',
            'diskon' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $penjualan = Penjualan::create([
            'TglNota' => $request->tgl_nota,
            'Pelanggan_id' => $request->pelanggan_id, // 'Pelanggan_id' adalah nama kolom di tabel 'penjualan
            'diskon' => $request->diskon,
        ]);

        $penjualan->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('penjualan.index')->with('message', 'Berhasil menambah data');
    }


    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pelanggan = Pelanggan::get();
        return view('penjualan.edit', compact('penjualan', 'pelanggan'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_nota' => 'required',
            'pelanggan_id' => 'required',
            'diskon' => 'required',
        ]);

        // Temukan penjualan berdasarkan ID
        $penjualan = Penjualan::findOrFail($id);

        // Perbarui data penjualan dengan data yang diterima dari permintaan
        $penjualan->TglNota = $request->tgl_nota;
        $penjualan->Pelanggan_id = $request->pelanggan_id;
        $penjualan->diskon = $request->diskon;

        // Simpan perubahan
        $penjualan->save();

        // Redirect ke halaman daftar penjualan dengan pesan sukses
        return redirect()->route('penjualan.index')->with('message', 'Berhasil memperbarui data penjualan');
    }


    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pelanggan = Pelanggan::get();
        $detail = Penjualan_detail::where('Penjualan_id', $id)->get();
        return view('penjualan.detail', compact('penjualan', 'pelanggan', 'detail'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:penjualan,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        penjualan::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menghapus data');
    }
}
