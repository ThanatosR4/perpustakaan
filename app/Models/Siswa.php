<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method bool update(array $attributes = [], array $options = [])
 * @method $this fill(array $attributes)
 */
class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'kode', 'nama', 'kelas', 'jenis_kelamin', 'password',
        'tempat_lahir', 'tanggal_lahir', 'telepon', 'email', 'alamat', 'foto'
    ];

    protected $hidden = ['password'];


}
