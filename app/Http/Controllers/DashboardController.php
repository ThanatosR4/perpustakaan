<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        return view('dashboard.index');
    }

    function show()
    {
        $siswaCount = Siswa::count();

        $bukuCount = Buku::count();

        return view('dashboard.profile', compact('siswaCount', 'bukuCount'));
    }

    

}
