<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporankendala;

class LaporankendalaController extends Controller
{
    // --- 1. KELOLA LAPORAN (KHUSUS ADMIN) ---
    public function index()
    {
        // Ambil data laporan terbaru untuk ditampilkan di tabel admin
        $laporans = Laporankendala::latest()->get();

        // Arahkan ke view admin.laporan (tabel penuh tanpa form)
        return view('admin.laporan', compact('laporans'));
    }

    // Mengubah status laporan menjadi Selesai (Admin)
    public function selesaikan($id)
    {
        $laporan = Laporankendala::findOrFail($id);
        $laporan->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diubah menjadi Selesai!');
    }

    // Menghapus laporan (Admin)
    public function destroy($id)
    {
        $laporan = Laporankendala::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan kendala berhasil dihapus!');
    }


    // --- 2. FORMULIR LAPORAN (KHUSUS PENGGUNA / SISWA) ---
    public function userIndex()
    {
        // Ambil data laporan untuk ditampilkan ke siswa (jika ada riwayat)
        $laporans = Laporankendala::latest()->get();

        // Arahkan ke view laporan.index (halaman yang ada form-nya)
        return view('laporan.index', compact('laporans'));
    }

    // Menyimpan data laporan dari formulir siswa
    public function userStore(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'unit_proyektor' => 'required|string|max:255',
            'kendala' => 'required|string', // Diubah dari 'deskripsi' menjadi 'kendala'
        ]);

        Laporankendala::create([
            'nama_pelapor' => $request->nama_pelapor,
            'kelas' => $request->kelas,
            'unit_proyektor' => $request->unit_proyektor,
            'kendala' => $request->kendala, // Diubah dari 'deskripsi' menjadi 'kendala'
            'status' => 'Pending',
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan kendala berhasil dikirim!');
    }
}