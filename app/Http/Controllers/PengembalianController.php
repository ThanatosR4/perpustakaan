<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
    $query = Pengembalian::with(['pinjaman.buku', 'pinjaman.siswa']);

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->whereHas('pinjaman.siswa', function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('kode', 'like', "%$search%");
        })->orWhereHas('pinjaman.buku', function ($q) use ($search) {
            $q->where('judul', 'like', "%$search%");
        });
    }

    
    $query->orderBy('tanggal_kembali', 'desc');

    $pengembalian = $query->paginate(20)->appends(['search' => $request->search]);

    return view('pengembalian.index', compact('pengembalian'));
    }



    public function store(Request $request)
    {
    $request->validate([
        'pinjaman_id' => 'required|exists:pinjaman,id',
    ]);

    $peminjaman = Peminjaman::findOrFail($request->pinjaman_id);

    
    $buku = $peminjaman->buku;
    $buku->stok += 1;
    $buku->save();

    
    $peminjaman->status = 'dikembalikan';
    $peminjaman->save();

    Pengembalian::create([
        'pinjaman_id' => $peminjaman->id,
        'tanggal_kembali' => now(),
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
    }
    public function kembalikan($id)
    {
    $peminjaman = Peminjaman::findOrFail($id);

    
    $buku = $peminjaman->buku;
    $buku->stok += 1;
    $buku->save();

    
    $peminjaman->status = 'sudah kembali';
    $peminjaman->save();

    
    Pengembalian::create([
        'pinjaman_id' => $peminjaman->id,
        'tanggal_kembali' => now(),
        'user_id' => Auth::id(), 
    ]);

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
    }

    public function print(Request $request)
{
    $range = $request->range;
    $query = Pengembalian::with(['pinjaman.siswa', 'pinjaman.buku']);

    if ($range == '7') {
        $query->where('tanggal_kembali', '>=', Carbon::now()->subDays(7));
    } elseif ($range == '30') {
        $query->where('tanggal_kembali', '>=', Carbon::now()->subDays(30));
    } elseif ($range == 'custom') {
        $query->whereBetween('tanggal_kembali', [$request->start_date, $request->end_date]);
    }

    $pengembalian = $query->orderBy('tanggal_kembali', 'desc')->get();

    return view('pengembalian.print', compact('pengembalian'));
}

}
