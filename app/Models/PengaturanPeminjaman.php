<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'pengaturan_peminjamans';

    protected $fillable = [
        'maksimal_hari',
        'maksimal_buku',
    ];
}
