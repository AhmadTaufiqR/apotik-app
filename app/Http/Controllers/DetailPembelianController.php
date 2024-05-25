<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pembelian_detail;
use App\Models\Penjualan_detail;
use Illuminate\Http\Request;

class DetailPembelianController extends Controller
{
    public function index($id)
    {
        $obat = Obat::get();
        return view('detail_pembelian.create', compact('id', 'obat'));
    }


    public function create($id)
    {
        return view('detail_pembelian.create', compact('id'));
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'notaId' => 'required',
            'obat_id' => 'required',
            'jumlah' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $Penjualan_detail = Pembelian_detail::create([
            'Pembelian_id' => $request->notaId,
            'Obat_id' => $request->obat_id, // 'Penjualan_detail_id' adalah nama kolom di tabel 'Penjualan_detail
            'Jumlah' => $request->jumlah,
        ]);

        $Penjualan_detail->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('pembelian.index')->with('message', 'Berhasil menambah data');
    }


    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $Penjualan_detail = Penjualan_detail::findOrFail($id);
        $Penjualan_detail = Penjualan_detail::get();
        return view('Penjualan_detail.edit', compact('Penjualan_detail', 'Penjualan_detail'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_nota' => 'required',
            'Penjualan_detail_id' => 'required',
            'diskon' => 'required',
        ]);

        // Temukan Penjualan_detail berdasarkan ID
        $Penjualan_detail = Penjualan_detail::findOrFail($id);

        // Perbarui data Penjualan_detail dengan data yang diterima dari permintaan
        $Penjualan_detail->TglNota = $request->tgl_nota;
        $Penjualan_detail->Penjualan_detail_id = $request->Penjualan_detail_id;
        $Penjualan_detail->diskon = $request->diskon;

        // Simpan perubahan
        $Penjualan_detail->save();

        // Redirect ke halaman daftar Penjualan_detail dengan pesan sukses
        return redirect()->route('Penjualan_detail.index')->with('message', 'Berhasil memperbarui data Penjualan_detail');
    }


    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $Penjualan_detail = Penjualan_detail::findOrFail($id);
        $Penjualan_detail = Penjualan_detail::get();
        return view('Penjualan_detail.detail', compact('Penjualan_detail', 'Penjualan_detail'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:Penjualan_detail,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        Penjualan_detail::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menghapus data');
    }
}
