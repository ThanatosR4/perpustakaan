@extends('layout.welcome')

@section('title', 'Pengembalian')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h4>Pengembalian Buku</h4>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4>Data Pengembalian Buku</h4>
                    
                    <div class="d-flex align-items-center">
                        <!-- Tombol Print -->
                        {{-- <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#modal-print">
                            <i class="fas fa-print"></i> Print Data
                        </button> --}}

                        <!-- Form Pencarian -->
                        <form action="{{ route('pengembalian.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, NISN, atau judul buku..." value="{{ request()->get('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card-body p-0">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>NISN</th>
                                <th>Email</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengembalian as $index => $item)
                            <tr>
                                <td>{{ $pengembalian->firstItem() + $index }}</td>
                                <td>{{ $item->pinjaman->siswa->nama ?? '-' }}</td>
                                <td>{{ $item->pinjaman->siswa->kelas ?? '-' }}</td>
                                <td>{{ $item->pinjaman->siswa->kode ?? '-' }}</td>
                                <td>{{ $item->pinjaman->siswa->email ?? '-' }}</td>
                                <td>{{ $item->pinjaman->buku->judul ?? '-' }}</td>
                                <td>{{ $item->pinjaman->tanggal_pinjam ?? '-' }}</td>
                                <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                                <td>{{ $item->pinjaman->keterangan ?? '-' }}</td>
                                <td><span class="badge badge-success">Dikembalikan</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data pengembalian.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pengembalian->count())
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        Showing {{ $pengembalian->firstItem() }} to {{ $pengembalian->lastItem() }} of {{ $pengembalian->total() }} entries
                    </div>
                    <div>
                        {{ $pengembalian->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@include('pengembalian.detail')
@include('pengembalian.print')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rangeSelect = document.getElementById('range');
        const customRange = document.getElementById('custom-date-range');

        rangeSelect.addEventListener('change', function () {
            if (this.value === 'custom') {
                customRange.classList.remove('d-none');
            } else {
                customRange.classList.add('d-none');
            }
        });
    });
</script>
@endpush

