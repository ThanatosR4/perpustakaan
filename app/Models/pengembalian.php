<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    
    protected $table = 'pengembalian';

    protected $fillable = ['pinjaman_id', 'tanggal_kembali', 'user_id'];

    public function pinjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pinjaman_id');
    }

    public function buku()
    {
    return $this->pinjaman ? $this->pinjaman->buku : null;
    }

    public function siswa()
    {
    return $this->pinjaman ? $this->pinjaman->siswa : null;
    }
    
}
