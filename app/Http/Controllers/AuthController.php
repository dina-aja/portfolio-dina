<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Proses login
    public function loginPost(Request $request)
    {
        // Validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek login
        if (Auth::attempt($credentials))
        {
            // Membuat session baru
            $request->session()->regenerate();

            // Redirect ke dashboard admin
            return redirect('/dashboard');
        }

        // Jika gagal login
        return back()->with('error', 'Email atau Password salah');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Generate token baru
        $request->session()->regenerateToken();

        // Kembali ke halaman login
        return redirect('/');
    }
}