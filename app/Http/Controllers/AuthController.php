<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // 1. Ambil data sesi gagal login
        $gagal = $request->session()->get('gagal_login', 0);

        // 2. Cek apakah sudah melebihi batas (>= 3)
        if ($gagal >= 3) {
            return redirect()->route('landing')
                ->with('error', 'Anda tidak bisa login karena melebihi batas percobaan.');
        }

        // 3. Proses autentikasi menggunakan username dan password
        if (Auth::attempt(['username' => $validate['username'], 'password' => $validate['password']])) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek status akun aktif atau tidak
            if ($user->status !== 'Aktif') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'username' => 'Akun Anda sedang nonaktif. Silakan hubungi Admin.',
                ])->onlyInput('username');
            }

            // Cek hak akses role
            if (!in_array($user->role, ['Admin', 'Operator'])) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'username' => 'Akun Anda tidak memiliki hak akses ke dashboard.',
                ])->onlyInput('username');
            }

            // 4. BERHASIL: Hapus session gagal_login agar limitnya bersih kembali
            $request->session()->forget('gagal_login');

            return redirect()->route('admin.index')
                ->with('success', 'Selamat datang di dashboard.');
        }

        // 5. Jika password atau username salah, tambahkan counter gagal
        $gagal++;
        $request->session()->put('gagal_login', $gagal);

        // Jika setelah ditambah ternyata mencapai 3 kali gagal
        if ($gagal >= 3) {
            return redirect()->route('landing')
                ->with('error', 'Login gagal karena melebihi batas percobaan.');
        }

        return back()->withErrors([
            'username' => 'username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
