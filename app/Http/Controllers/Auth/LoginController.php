<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
                return redirect()->route('dasboard_pelanggan');
            } elseif (Auth::user()->hasAnyRole(['Admin', 'Apoteker'])) {
                return redirect()->route('dashboard');
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

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::user()->id);

            //dd($user);

            // Simpan peran pengguna dalam sesi
            session(['user_role' => $user->role]);

            // Redirect based on the user's role
            if ($user->hasRole('Pelanggan')) {
                return redirect()->route('dashboard_pelanggan');
            } elseif ($user->hasRole('Admin')) {
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('Apotek')) {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->back()->withInput($request->only('Username'))->with('error', 'Username dan Password Salah !');
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
