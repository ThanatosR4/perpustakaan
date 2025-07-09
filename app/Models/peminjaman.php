<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';

    protected $fillable = [
        'tanggal_pinjam',
        'lama_pinjam',
        'keterangan',
        'status',
        'siswa_id',
        'nama'
    ];

}
