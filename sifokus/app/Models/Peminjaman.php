<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'peminjam',
        'nama_peminjam',
        'kelas',
        'unit_proyektor',
        'tanggal',
        'kartu_pelajar',
        'status',
    ];
}