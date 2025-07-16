<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $query = Peminjaman::with(['siswa', 'buku']);

    
    if ($request->filled('search')) {
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

    
    if ($request->filled('status') && $request->status != 'semua') {
        $query->where('status', $request->status);
    }

    $tanggalDari = $request->tanggal_dari;
    $tanggalSampai = $request->tanggal_sampai;

    if ($tanggalDari && $tanggalSampai) {
        $query->whereDate('tanggal_pinjam', '>=', $tanggalDari)
              ->whereDate('tanggal_pinjam', '<=', $tanggalSampai);
    }

    $laporan = $query->orderBy('tanggal_pinjam', 'desc')->paginate(20);

    return view('laporan.index', compact('laporan', 'tanggalDari', 'tanggalSampai'));
    }

    public function cetak(Request $request)
    {
    
    $range = $request->range;
    $tanggalDari = $request->start_date;
    $tanggalSampai = $request->end_date;

    if ($range === '7') {
        $tanggalDari = now()->subDays(6)->toDateString();
        $tanggalSampai = now()->toDateString();
    } elseif ($range === '30') {
        $tanggalDari = now()->subDays(29)->toDateString();
        $tanggalSampai = now()->toDateString();
    }

    $query = Peminjaman::with(['siswa', 'buku']);

    if ($tanggalDari && $tanggalSampai) {
        $query->whereDate('tanggal_pinjam', '>=', $tanggalDari)
              ->whereDate('tanggal_pinjam', '<=', $tanggalSampai);
    }

    $laporan = $query->orderBy('tanggal_pinjam', 'desc')->get();

    return view('laporan.cetak-preview', compact('laporan', 'tanggalDari', 'tanggalSampai'));
    }

    public function preview(Request $request)   
    {
    $range = $request->range;
    $tanggalDari = $request->start_date;
    $tanggalSampai = $request->end_date;
    $status = $request->status;

    if ($range === '7') {
        $tanggalDari = now()->subDays(6)->toDateString();
        $tanggalSampai = now()->toDateString();
    } elseif ($range === '30') {
        $tanggalDari = now()->subDays(29)->toDateString();
        $tanggalSampai = now()->toDateString();
    }

    $query = Peminjaman::with(['siswa', 'buku']);

    if ($tanggalDari && $tanggalSampai) {
        $query->whereDate('tanggal_pinjam', '>=', $tanggalDari)
              ->whereDate('tanggal_pinjam', '<=', $tanggalSampai);
    }

    if ($status && $status !== 'semua') {
        $query->where('status', $status);
    }

    $laporan = $query->orderBy('tanggal_pinjam', 'desc')->get();

    return view('laporan._preview_table', compact('laporan', 'tanggalDari', 'tanggalSampai', 'status'))->render();
    }

    public function cetakPdf(Request $request)
    {
    $range = $request->range;
    $tanggalDari = $request->start_date;
    $tanggalSampai = $request->end_date;
    $status = $request->status;

    if ($range === '7') {
        $tanggalDari = now()->subDays(6)->toDateString();
        $tanggalSampai = now()->toDateString();
    } elseif ($range === '30') {
        $tanggalDari = now()->subDays(29)->toDateString();
        $tanggalSampai = now()->toDateString();
    }

    $query = Peminjaman::with(['siswa', 'buku']);

    if ($tanggalDari && $tanggalSampai) {
        $query->whereBetween('tanggal_pinjam', [$tanggalDari, $tanggalSampai]);
    }

    if ($status && $status !== 'semua') {
        $query->where('status', $status);
    }

    $laporan = $query->orderBy('tanggal_pinjam', 'desc')->get();

    $pdf = Pdf::loadView('laporan._preview_pdf', compact('laporan', 'tanggalDari', 'tanggalSampai', 'status'))
              ->setPaper('a4', 'landscape');

    $judulFile = 'laporan-peminjaman-pengembalian.pdf';
    if ($status === 'dipinjam') {
        $judulFile = 'laporan-peminjaman.pdf';
    } elseif ($status === 'sudah kembali') {
        $judulFile = 'laporan-pengembalian.pdf';
    }

    return $pdf->download($judulFile);
    }

}
