<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('peminjam'); // Kolom nama peminjam
            $table->string('kelas');
            $table->string('unit_proyektor');
            $table->date('tanggal'); // Kolom tanggal peminjaman
            $table->string('kartu_pelajar')->nullable();
            $table->string('status')->default('Dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};