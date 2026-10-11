<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporankendalaController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTE KHUSUS ADMIN (LOGIN & REGISTER)
// ==========================================

Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        Auth::logout();
        throw ValidationException::withMessages([
            'email' => 'Akun Anda tidak memiliki hak akses sebagai admin.',
        ]);
    }

    throw ValidationException::withMessages([
        'email' => 'Email atau password salah.',
    ]);
});

Route::get('/admin/register', function () {
    return view('auth.admin-register');
})->name('admin.register');

Route::post('/admin/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'admin',
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/admin/dashboard');
});


// ==========================================
// RUTE PENGGUNA / USER BIASA & PROFIL
// ==========================================

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Peminjaman dari sisi pengguna
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    
    // Tombol selesai dipinjam dari sisi pengguna
    Route::patch('/peminjaman/{id}/selesaikan', [PeminjamanController::class, 'selesaikan'])->name('peminjaman.selesaikan');

    // Rute Laporan Kendala Khusus Pengguna
    Route::get('/laporan', [LaporankendalaController::class, 'userIndex'])->name('laporan.index');
    Route::post('/laporan', [LaporankendalaController::class, 'userStore'])->name('laporan.store');

    // Rute Profil Standar (Digunakan bersama oleh User dan Admin, URL: /profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// RUTE KELOLA / PANEL ADMIN
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Kelola Peminjaman Admin
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    // Kelola Laporan Kendala Khusus Admin
    Route::get('/laporan', [LaporankendalaController::class, 'index'])->name('laporan.index');
    Route::patch('/laporan/{id}/selesaikan', [LaporankendalaController::class, 'selesaikan'])->name('laporan.selesaikan');
    Route::delete('/laporan/{id}', [LaporankendalaController::class, 'destroy'])->name('laporan.destroy');
});

require __DIR__.'/auth.php';