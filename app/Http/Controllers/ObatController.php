<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Suplier;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::with('suplier')->get();
        return view('obat.index', compact('obat'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $obat = Obat::where('NmObat', 'like', '%' . $searchTerm . '%')->get();

        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        $supliers = Suplier::get();

        return view('obat.create', compact('supliers'));
    }


    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'jenis' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'kadaluarsa' => 'required',
            'suplier_id' => 'required|exists:suplier,id', // Pastikan suplier_id ada di tabel supliers
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $obat = Obat::create([
            'NmObat' => $request->name,
            'Jenis' => $request->jenis,
            'Satuan' => $request->satuan,
            'HargaBeli' => $request->harga_beli,
            'HargaJual' => $request->harga_jual,
            'Stok' => $request->stok,
            'kadaluarsa' => $request->kadaluarsa,
            'Suplier_id' => $request->suplier_id,
        ]);

        $obat->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('obat.index')->with('message', 'Berhasil menambah data');
    }


    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $supliers = Suplier::get();
        return view('obat.edit', compact('obat', 'supliers'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'jenis' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'kadaluarsa' => 'required',
            'suplier_id' => 'required|exists:suplier,id', // Pastikan suplier_id ada di tabel supliers
        ]);

        // Temukan obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Perbarui data obat dengan data yang diterima dari permintaan
        $obat->NmObat = $request->name;
        $obat->Jenis = $request->jenis;
        $obat->Satuan = $request->satuan;
        $obat->HargaBeli = $request->harga_beli;
        $obat->HargaJual = $request->harga_jual;
        $obat->Stok = $request->stok;
        $obat->kadaluarsa = $request->kadaluarsa;
        $obat->Suplier_id = $request->suplier_id;

        // Simpan perubahan
        $obat->save();

        // Redirect ke halaman daftar obat dengan pesan sukses
        return redirect()->route('obat.index')->with('message', 'Berhasil memperbarui data obat');
    }


    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $obat = Obat::findOrFail($id);
        $supliers = Suplier::get();
        return view('obat.detail', compact('obat', 'supliers'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:obat,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        Obat::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menghapus data');
    }
}
