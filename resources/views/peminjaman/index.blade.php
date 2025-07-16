@extends('layout.welcome')

@section('title', 'Peminjaman')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman Buku</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Peminjaman</h4>
                    <form action="{{ route('peminjaman.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama, NISN, judul buku..." value="{{ request()->get('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Judul Buku</th>
                                <th>Denda</th>
                                <th style="width: 25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pinjaman as $key => $item)
                            @php
                                $tanggalKembali = \Carbon\Carbon::parse($item->tanggal_pinjam)->addDays($item->lama_pinjam);
                                $hariTerlambat = now()->diffInDays($tanggalKembali, false); // nilai negatif kalau belum jatuh tempo
                                $denda = 0;
                                if ($item->status === 'dipinjam' && $hariTerlambat < 0 && $pengaturanDenda) {
                                    $denda = abs($hariTerlambat) * $pengaturanDenda->jumlah_per_hari;
                                }
                            @endphp
                            <tr>
                                <td>{{ $pinjaman->firstItem() + $key }}</td>
                                <td>{{ Str::limit($item->siswa->kode, 6, '...') }}</td>
                                <td>{{ $item->siswa->nama ?? '-' }}</td>
                                <td>{{ Str::limit($item->keterangan, 10, '...') }}</td>
                                <td>
                                    @if ($item->status === 'dipinjam')
                                        @php $status = $item->status_pengembalian; @endphp

                                        @if ($status === 'Segera dikembalikan')
                                            <span class="badge badge-warning">{{ $status }}</span>
                                        @elseif ($status === 'Terlambat dikembalikan')
                                            <span class="badge badge-danger">{{ $status }}</span>
                                        @else
                                            <span class="badge badge-primary">{{ $status }}</span>
                                        @endif
                                    @else
                                        <span class="badge badge-success">Sudah Dikembalikan</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->addDays($item->lama_pinjam)->format('Y-m-d') }}</td>
                                <td>{{ $item->buku->judul ?? '-' }}</td>
                                <td>
                                    @if ($denda > 0)
                                        <span class="badge badge-danger">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="badge badge-success">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status === 'dipinjam')
                                    <form action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST" id="kembali-form-{{ $item->id }}" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm" onclick="confirmKembali('kembali-form-{{ $item->id }}')">
                                            <i class="fa fa-undo"></i> Kembalikan
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fa fa-check"></i> Sudah Kembali
                                    </button>
                                    @endif
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail-{{ $item->id }}">
                                        <i class="fa fa-info"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @include('peminjaman.detail', ['item' => $item])
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        Menampilkan {{ $pinjaman->firstItem() }} sampai {{ $pinjaman->lastItem() }} dari {{ $pinjaman->total() }} entri
                    </div>
                    <div class="float-right mt-2">
                        {{ $pinjaman->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@include('peminjaman.detail')

@push('scripts')
<script>
    function confirmKembali(formId){
        event.preventDefault();
        swal({
            title: 'Konfirmasi Pengembalian',
            text: 'Apakah anda yakin buku ini sudah dikembalikan?',
            icon: 'warning',
            buttons: true,
        }).then((willReturn) => {
            if (willReturn) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush
