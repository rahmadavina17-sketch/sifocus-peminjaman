<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporankendala extends Model
{
    use HasFactory;

    protected $table = 'laporan_kendalas'; // Wajib ada agar tidak mencari laporankendas

    protected $fillable = [
        'nama_pelapor',
        'kelas',
        'unit_proyektor',
        'kendala',
        'status',
    ];
}