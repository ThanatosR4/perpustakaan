<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use Carbon\Carbon;
use App\Models\PengaturanDenda;

class PeminjamanController extends Controller
{
    public function index(Request $request)
{
    $query = Peminjaman::with(['buku', 'siswa'])
        ->where('status', 'dipinjam');

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('siswa', function ($qs) use ($search) {
                $qs->where('nama', 'like', "%$search%")
                   ->orWhere('kode', 'like', "%$search%");
            })->orWhereHas('buku', function ($qb) use ($search) {
                $qb->where('judul', 'like', "%$search%");
            });
        });
    }

    
    $pinjaman = $query
    ->orderByRaw("CASE WHEN status = 'dipinjam' THEN 0 ELSE 1 END") 
    ->orderByRaw("CASE WHEN status = 'dipinjam' THEN DATE_ADD(tanggal_pinjam, INTERVAL lama_pinjam DAY) ELSE NULL END ASC") // urutkan tanggal kembali terdekat
    ->paginate(20);

    $pinjaman->getCollection()->transform(function ($item) {
        $tanggalKembali = Carbon::parse($item->tanggal_kembali);
        $hariIni = now();

        if ($hariIni->between($tanggalKembali->copy()->subDays(2), $tanggalKembali)) {
            $item->status_pengembalian = 'Segera dikembalikan';
        } elseif ($hariIni->gt($tanggalKembali)) {
            $item->status_pengembalian = 'Terlambat dikembalikan';
        } else {
            $item->status_pengembalian = 'Masih dalam masa pinjam';
        }

        return $item;
    });

     $pengaturanDenda = PengaturanDenda::first(); 

    return view('peminjaman.index', compact('pinjaman','pengaturanDenda'));
    }

    
    public function kembalikan($id)
    {
    $peminjaman = Peminjaman::with('buku')->findOrFail($id);

    
    $peminjaman->status = 'sudah kembali';
    $peminjaman->save();

    
    $buku = $peminjaman->buku;
    $buku->stok += 1;
    $buku->save();

    
    Pengembalian::create([
        'pinjaman_id' => $peminjaman->id,
        'tanggal_kembali' => now(),
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
}



}
