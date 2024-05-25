<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        $suplier = Suplier::get();
        return view('suplier.index', compact('suplier'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $suplier = Suplier::where('NmSuplier', 'like', '%' . $searchTerm . '%')->get();

        return view('suplier.index', compact('suplier'));
    }




    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('suplier.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $suplier = Suplier::create([
            'NmSuplier' => $request->name,
            'Telpon' =>  $request->phone_number,
            'Alamat' => $request->address,
            'Kota' => $request->city,
        ]);

        $suplier->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('suplier.index')->with('message', 'Berhasil menambah data');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('suplier.edit', compact('suplier'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Temukan pengguna berdasarkan ID
        $suplier = Suplier::findOrFail($id);

        // Perbarui data pengguna
        $suplier->NmSuplier = $request->name;
        $suplier->Telpon = $request->phone_number;
        $suplier->Alamat = $request->address;
        $suplier->Kota = $request->city;

        // Simpan perubahan
        $suplier->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('suplier.index')->with('message', 'Berhasil memperbarui data');
    }

    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('suplier.detail', compact('suplier'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:suplier,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        Suplier::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('suplier.index')->with('message', 'Berhasil menghapus data');
    }
}
