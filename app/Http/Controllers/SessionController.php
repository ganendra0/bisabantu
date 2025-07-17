<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Contracts\Session\Session; // Ini tidak perlu di-import

class SessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    function index()
    {
        return view("session.index"); // Gunakan titik untuk path view
    }

    /**
     * Memproses request login dari pengguna.
     */
    function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);

        // 2. Siapkan kredensial untuk login
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // 3. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            return redirect()->intended('/donasi'); // Redirect ke halaman yang dituju atau default ke /donasi
        }

        // 4. Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username'); // Kembalikan ke halaman login dengan pesan error dan input username
    }

    /**
     * Memproses logout pengguna.
     */
    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect ke halaman utama
    }

    /**
     * Menampilkan halaman registrasi.
     */
    function register()
    {
        return view('session.register'); // Gunakan titik untuk path view
    }

    /**
     * Memproses data registrasi dan membuat user baru.
     */
    function create(Request $request)
    {
        // 1. Validasi input dengan aturan baru
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed', // INI PERUBAHAN UTAMANYA
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.', // Pesan error jika password tidak sama
        ]);

        // 2. Jika validasi lolos, buat user baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jenisAkun' => 'guest' // Atur peran default
        ]);

        // 3. (Opsional) Login-kan user secara otomatis setelah registrasi
        // Auth::login($user);

        // 4. Redirect ke halaman login dengan pesan sukses
        return redirect('/session') // atau url('session/index')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
    }
}