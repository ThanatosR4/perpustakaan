<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanDenda extends Model
{
    use HasFactory;
    protected $table = 'pengaturan_denda';

    protected $fillable = [
        'denda_per_hari',
    ];
}
