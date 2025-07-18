<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    use HasFactory;
    
    protected $table = 'buku';

    protected $fillable = ['kode', 'judul', 'kategori_id', 'penerbit_id', 'isbn', 'pengarang', 'jumlah_halaman', 'stok', 'tahun_terbit', 'sinopsis', 'gambar'];
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
}
