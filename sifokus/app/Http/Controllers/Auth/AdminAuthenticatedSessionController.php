<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    // Tampilkan view login admin
    public function create()
    {
        return view('auth.admin-login');
    }

    // Proses login khusus admin
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah benar rolenya admin
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // Jika bukan admin, keluarkan lalu kembalikan error
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun ini bukan Administrator.',
            ])->onlyInput('email');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}