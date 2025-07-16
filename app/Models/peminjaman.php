<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';

    protected $fillable = [
        'tanggal_pinjam',
        'lama_pinjam',
        'tanggal_kembali',
        'keterangan',
        'status',
        'siswa_id',
        'nama',
        'buku_id'
    ];

    public function buku()
    {
    return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function siswa()
    {
    return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pengembalian()
    {
    return $this->hasOne(Pengembalian::class, 'pinjaman_id');
    }
}
