<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman
    public function index()
    {
        $peminjamans = Peminjaman::latest()->get();
        $laporans = \App\Models\Laporankendala::latest()->get();

        // Jika yang login adalah admin, arahkan ke view khusus admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.peminjaman', compact('peminjamans', 'laporans'));
        }

        // Jika user biasa, arahkan ke view standar
        return view('peminjaman.index', compact('peminjamans', 'laporans'));
    }

    // Menampilkan form untuk mengajukan peminjaman baru
    public function create()
    {
        return view('peminjaman.create');
    }

    // Menyimpan data peminjaman baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'unit_proyektor' => 'required|string|max:255',
            'kartu_pelajar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('kartu_pelajar')) {
            $path = $request->file('kartu_pelajar')->store('kartu_pelajar', 'public');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'peminjam' => $request->nama_peminjam,
            'kelas' => $request->kelas,
            'unit_proyektor' => $request->unit_proyektor,
            'tanggal' => date('Y-m-d'), // Tanggal otomatis hari ini
            'kartu_pelajar' => $path,
            'status' => 'Dipinjam',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan!');
    }

    // Mengubah status peminjaman menjadi selesai/dikembalikan
    public function selesaikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pemberitahuan: Peminjaman proyektor telah berhasil diselesaikan!');
    }

    // Menghapus data peminjaman (Khusus Admin)
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Hapus file foto kartu pelajar jika ada
        if ($peminjaman->kartu_pelajar && \Illuminate\Support\Facades\Storage::disk('public')->exists($peminjaman->kartu_pelajar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($peminjaman->kartu_pelajar);
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}