<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       // Melakukan otentikasi pengguna
    $request->authenticate();

    // Regenerasi session untuk mencegah session fixation
    $request->session()->regenerate();

    // Mendapatkan pengguna yang sudah login
    $user = $request->user();

    // Cek apakah peran pengguna adalah admin
    if ($user->role->id == 1) {
        // Arahkan ke halaman admin jika peran pengguna adalah admin
        return redirect()->route('AdminHome');
    }

    // Cek jika pengguna adalah mahasiswa (role_id 2)
    if ($user->role->id == 2) {
        // Arahkan ke halaman dashboard mahasiswa
        return redirect()->route('PegawaiHome');
    }

    if ($user->role->id == 3) {
        // Arahkan ke halaman dashboard mahasiswa
        return redirect()->route('MahasiswaHome');
    }

    // Jika peran lainnya atau tidak ada yang cocok, arahkan ke home umum
    return redirect()->route('layouts.home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
