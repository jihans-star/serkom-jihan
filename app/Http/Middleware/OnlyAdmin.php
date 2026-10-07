<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->status !== 'Aktif') {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'Akun Anda sedang nonaktif.');
        }

        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('admin.index')
                ->with('error', 'Anda tidak memiliki hak akses untuk membuka halaman tersebut.');
        }

        return $next($request);
    }
}
