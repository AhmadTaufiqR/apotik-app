<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Membuat pengguna baru dengan memetakan atribut form ke kolom database
        $pelanggan = Pelanggan::create([
            'NmPelanggan' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Telpon' =>  $request->phone_number,
            'Alamat' => $request->address,
            'Kota' => $request->city,
        ]);

        // Beri peran 'Apoteker' kepada pengguna baru
        $role = Role::findByName('Pelanggan');
        $pelanggan->assignRole($role);


        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('login')->with('message', 'Berhasil');
    }
}
