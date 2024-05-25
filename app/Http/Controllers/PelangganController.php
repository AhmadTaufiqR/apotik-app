<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::get();
        return view('pelanggan.index', compact('pelanggan'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $pelanggan = Pelanggan::where('NmPelanggan', 'like', '%' . $searchTerm . '%')->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('pelanggan.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $pelanggan = Pelanggan::create([
            'NmPelanggan' => $request->name,
            'Username' => $request->username,
            'Sandi' => $request->password,
            'Telpon' =>  $request->phone_number,
            'Alamat' => $request->address,
            'Kota' => $request->city,
        ]);

        // Beri peran 'Apoteker' kepada pengguna baru
        $role = Role::findByName('Pelanggan');
        $pelanggan->assignRole($role);


        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('message', 'Berhasil menambah data');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'password' => 'nullable|min:8',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Temukan pengguna berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Perbarui data pengguna
        $pelanggan->NmPelanggan = $request->name;
        $pelanggan->Username = $request->username;
        $pelanggan->Telpon = $request->phone_number;
        // Jika password diisi, perbarui password
        if ($request->filled('password')) {
            $pelanggan->Sandi = Hash::make($request->password);
        }
        $pelanggan->Alamat = $request->address;
        $pelanggan->Kota = $request->city;

        // Simpan perubahan
        $pelanggan->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('message', 'Berhasil memperbarui data');
    }

    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.detail', compact('pelanggan'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:pelanggan,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        Pelanggan::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('pelanggan.index')->with('message', 'Berhasil menghapus data');
    }
}
