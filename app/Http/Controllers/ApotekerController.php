<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ApotekerController extends Controller
{

    public function index()
    {
        $apoteker = User::role('Apoteker')->get();
        return view('apoteker.index', compact('apoteker'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $apoteker = User::role('Apoteker')
            ->where('nama', 'like', '%' . $searchTerm . '%')
            ->get();

        return view('apoteker.index', compact('apoteker'));
    }


    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('apoteker.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $apoteker = User::create([
            'Nama' => $request->name,
            'Username' => $request->username,
            'Sandi' => Hash::make($request->password),
        ]);


        // Beri peran 'Apoteker' kepada pengguna baru
        $role = Role::findByName('Apoteker');
        $apoteker->assignRole($role);

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menambah data');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $apoteker = User::findOrFail($id);
        return view('apoteker.edit', compact('apoteker'));
    }

    // Menyimpan perubahan pengguna ke database
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
        ]);

        // Temukan pengguna berdasarkan ID
        $apoteker = User::findOrFail($id);

        // Perbarui data pengguna
        $apoteker->Nama = $request->name;
        $apoteker->Username = $request->username;

        // Jika password diisi, perbarui password
        if ($request->filled('password')) {
            $apoteker->Sandi = Hash::make($request->password);
        }

        // Simpan perubahan
        $apoteker->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('apoteker.index')->with('message', 'Berhasil memperbarui data');
    }

    // Menampilkan form edit pengguna
    public function detail($id)
    {
        $apoteker = User::findOrFail($id);
        return view('apoteker.detail', compact('apoteker'));
    }

    public function destroyMulti(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'ids' => 'required|array', // Pastikan ids adalah array
            'ids.*' => 'exists:users,id', // Pastikan setiap id ada dalam basis data Anda
        ]);

        // Lakukan penghapusan data berdasarkan ID yang diterima
        User::whereIn('id', $request->ids)->delete();

        // Redirect ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('apoteker.index')->with('message', 'Berhasil menghapus data');
    }
}
