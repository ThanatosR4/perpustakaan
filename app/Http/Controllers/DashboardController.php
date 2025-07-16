<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalBuku = Buku::count();

        $peminjamanHariIni = Peminjaman::whereDate('tanggal_pinjam', Carbon::today())->count();

        $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        $pengembalianHariIni = Pengembalian::whereDate('tanggal_kembali', Carbon::today())->count();

        $peminjamanTerbaru = Peminjaman::with('buku')->orderBy('created_at', 'desc')->limit(5)->get();

        
        $grafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create(null, $i)->locale('id')->isoFormat('MMMM');
            $grafik[$bulan] = Peminjaman::whereMonth('tanggal_pinjam', $i)->count();
        }

        return view('dashboard.index', compact(
            'totalSiswa',
            'totalBuku',
            'peminjamanHariIni',
            'bukuDipinjam',
            'pengembalianHariIni',
            'peminjamanTerbaru',
            'grafik'
        ));
    }
    public function show()
    {
    $user = Auth::user(); 

    return view('dashboard.profile', compact('user'));
    }

}
