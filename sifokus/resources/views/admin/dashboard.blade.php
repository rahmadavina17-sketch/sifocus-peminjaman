@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Judul Halaman dengan Logo Proyektor -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-indigo-700 flex items-center justify-center text-white shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin - SiFokus</h1>
        </div>

        <!-- Kotak Utama dengan Aksen Warna Tipis di Pinggir & Latar Belakang -->
        <div class="bg-white overflow-hidden shadow-md sm:rounded-xl p-6 border-2 border-indigo-100 bg-gradient-to-br from-indigo-50/30 via-white to-white">
            <!-- Bagian Halo Bersih Tanpa Logo -->
            <div class="mb-4">
                <h3 class="text-2xl font-extrabold text-gray-900">Halo, {{ Auth::user()->name }}! 👋</h3>
            </div>
            
            <p class="text-gray-600 mb-6">
                Selamat datang di Panel Utama Administrator SiFokus. Halaman ini terisolasi khusus untuk pengelolaan sistem dan akun dengan hak akses penuh.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                <div>
                    <p class="text-xs font-semibold text-indigo-700 uppercase">Email Terdaftar</p>
                    <p class="text-sm font-bold text-gray-800 mt-1">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-indigo-700 uppercase">Status Sistem</p>
                    <p class="text-sm font-bold text-emerald-600 mt-1">Aktif & Terproteksi (Admin)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection