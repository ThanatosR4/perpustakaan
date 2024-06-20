<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';

    protected $fillable = ['kode', 'nama', 'kelas','jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telepon', 'email', 'alamat', 'foto' ];

    protected $hidden = [
        'password',
    ];


}
