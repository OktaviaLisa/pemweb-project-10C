<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login dengan Auth Laravel
    public function loginProcess(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // ✅ Cek apakah login sebagai admin secara manual
    if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
        $request->session()->regenerate();
        return redirect()->route('admin')->with('success', 'Login sebagai Admin!');
    }

    // ✅ Login dengan Auth biasa
    if (Auth::attempt([
        'username' => $credentials['username'],
        'password' => $credentials['password'],
    ])) {
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
        'login_error' => 'Username atau password salah',
    ])->withInput();
}


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil logout');
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('register');
    }

    // Proses register
    public function registerProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'namalengkap' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'password' => $request->password,  // ini supaya mutator aktif dan password_hash terisi
        ]);



        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}