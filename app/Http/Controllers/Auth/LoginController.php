<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Jika pengguna sudah terotentikasi, arahkan mereka ke dashboard
            if (Auth::user()->hasRole('Pelanggan')) {
                return redirect()->route('ashboard-pelanggan.index');
            } elseif (Auth::user()->hasAnyRole(['Admin', 'Apoteker'])) {
                return redirect()->route('dashboard.index');
            }
        }

        // Jika belum terotentikasi, tampilkan halaman login
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba autentikasi untuk model User
        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::user()->id);

            session(['user_role' => $user->role]);
            // Redirect berdasarkan peran pengguna
            if ($user->hasRole('Pelanggan')) {
                return redirect()->route('ashboard-pelanggan.index');
            } elseif ($user->hasRole('Admin') || $user->hasRole('Apoteker')) {
                return redirect()->route('dashboard.index');
            }
        }

        // Jika autentikasi untuk model User gagal, coba untuk model Pelanggan
        $user = Pelanggan::where('email', $request->email)->first();

        // Periksa apakah pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Login pengguna
            // Auth::login($user);

            // Redirect ke dashboard_pelanggan jika peran adalah "Pelanggan"
            return redirect()->route('dashboard-pelanggan.index')->with('success', 'Login berhasil');
        }

        // Autentikasi gagal untuk kedua model, kembalikan dengan pesan error
        return redirect()->back()->withInput($request->only('email'))->with('error', 'Email atau password salah');
    }




    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
