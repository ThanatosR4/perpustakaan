<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    function index()
    {
        $pinjaman = Peminjaman::all();
        // dd($pinjaman->all());
        return view('peminjaman.index', compact('pinjaman'));
    }
}
