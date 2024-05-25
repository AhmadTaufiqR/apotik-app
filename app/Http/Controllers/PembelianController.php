<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pembelian_detail;
use App\Models\Penjualan_detail;
use App\Models\Suplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('suplier')->get();
        return view('pembelian.index', compact('pembelian'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $pembelian = Pembelian::where('TglNota', 'like', '%' . $searchTerm . '%')->get();

        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $supliers = Suplier::get();
        return view('pembelian.create', compact('supliers'));
    }


    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'tgl_nota' => 'required',
            'suplier_id' => 'required',
            'diskon' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $pembelian = Pembelian::create([
            'TglNota' => $request->tgl_nota,
            'Suplier_id' => $request->suplier_id,
            'diskon' => $request->diskon,
        ]);

        $pembelian->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('pembelian.index')->with('message', 'Berhasil menambah data');
    }


    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $supliers = Suplier::get();
        return view('pembelian.edit', compact('pembelian', 'supliers'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_nota' => 'required',
            'suplier_id' => 'required',
            'diskon' => 'required', // Pastikan suplier_id ada di tabel supliers
        ]);

        // Temukan pembelian berdasarkan ID
        $pembelian = Pembelian::findOrFail($id);

        // Perbarui data pembelian dengan data yang diterima dari permintaan
       $pembelian->TglNota = $request->tgl_nota;
        $pembelian->Suplier_id = $request->suplier_id;
        $pembelian->diskon = $request->diskon;

        // Simpan perubahan
        $pembelian->save();

        // Redirect ke halaman daftar pembelian dengan pesan sukses
        return redirect()->route('pembelian.index')->with('message', 'Berhasil memperbarui data pembelian');
    }


    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $supliers = Suplier::get();
        $detail = Pembelian_detail::where('Pembelian_id', $id)->get();
        return view('pembelian.detail', compact('pembelian', 'supliers', 'detail'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:pembelian,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        Pembelian::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menghapus data');
    }

    public function viewIndex()
    {
        return view('detail_pembelian.create');
    }

    public function storeDetail(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required',
            'obat_id' => 'required',
            'jumlah' => 'required',
        ]);

        Penjualan_detail::create([
            'Penjualan_id' => $request->penjualan_id,
            'Obat_id' => $request->obat_id,
            'Jumlah' => $request->jumlah,
        ]);

        return redirect()->route('penjualan.index')->with('message', 'Berhasil menambah detail penjualan');
    }
}
