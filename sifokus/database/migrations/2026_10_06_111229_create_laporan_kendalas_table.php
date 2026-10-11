<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kendalas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('kelas');
            $table->string('unit_proyektor');
            $table->text('kendala');
            $table->string('foto_bukti')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kendalas');
    }
};