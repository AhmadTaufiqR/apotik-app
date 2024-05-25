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
                return redirect()->route('obat_pelanggan.index');
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
        // // Get the credentials from the request
        // $credentials = $request->only('Username', 'Sandi');

        // // Map credentials to the fields used in the User model for authentication
        // $authCredentials = ['Username' => $credentials['Username'], 'Sandi' => $credentials['Sandi']];

        $credentials = [
            'Username' => session('Username'),
            'Sandi' => session('Sandi'),
        ];

        dd($credentials);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::user()->id);

            // Debugging output
            // dd($user);

            // Save the user's role in the session
            session(['user_role' => $user->role]);

            // Redirect based on the user's role
            if ($user->hasRole('Pelanggan')) {
                return redirect()->route('upts.index');
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
