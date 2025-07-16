@extends('layout.welcome')

@section('title', 'Laporan Peminjaman & Pengembalian')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Peminjaman & Pengembalian</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h4 class="mb-2 mb-md-0">Filter Data</h4>
                    <form action="{{ route('laporan.index') }}" method="GET" class="form-inline flex-wrap">
                        <div class="input-group mr-2 mb-2">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama, NISN, judul buku..." value="{{ request()->get('search') }}">
                        </div>
                        <div class="input-group mr-2 mb-2">
                            <select name="status" class="form-control">
                                <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="sudah kembali" {{ request('status') == 'sudah kembali' ? 'selected' : '' }}>Sudah Kembali</option>
                            </select>
                        </div>
                        <div class="input-group mr-2 mb-2">
                            <input type="date" class="form-control" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                        </div>
                        <div class="input-group mr-2 mb-2">
                            <input type="date" class="form-control" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                        </div>
                        <button class="btn btn-primary mb-2"><i class="fas fa-filter"></i> Filter</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <strong>Filter Cepat:</strong>
                                <div class="btn-group mt-2 mt-md-0" role="group">
                                    <a href="{{ route('laporan.index', ['tanggal_dari' => now()->format('Y-m-d'), 'tanggal_sampai' => now()->format('Y-m-d')]) }}"
                                    class="btn btn-outline-info btn-sm">Hari Ini</a>
                                    <a href="{{ route('laporan.index', ['tanggal_dari' => now()->subDays(6)->format('Y-m-d'), 'tanggal_sampai' => now()->format('Y-m-d')]) }}"
                                    class="btn btn-outline-info btn-sm">7 Hari Terakhir</a>
                                    <a href="{{ route('laporan.index', ['tanggal_dari' => now()->subDays(29)->format('Y-m-d'), 'tanggal_sampai' => now()->format('Y-m-d')]) }}"
                                    class="btn btn-outline-info btn-sm">30 Hari Terakhir</a>
                                </div>
                            </div>

                            <div class="mt-2 mt-md-0">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-cetak">
                                    <i class="fas fa-print"></i> Cetak Laporan
                                </button>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Lama</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan as $key => $item)
                            <tr>
                                <td>{{ $laporan->firstItem() + $key }}</td>
                                <td>{{ Str::limit($item->siswa->kode, 6, '...') }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                <td>{{ $item->buku->judul ?? '-' }}</td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ $item->lama_pinjam }} hari</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->addDays($item->lama_pinjam)->format('Y-m-d') }}</td>
                                <td>
                                    @if ($item->status === 'dipinjam')
                                        <span class="badge badge-warning">Dipinjam</span>
                                    @else
                                        <span class="badge badge-success">Sudah Kembali</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data laporan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        Menampilkan {{ $laporan->firstItem() }} sampai {{ $laporan->lastItem() }} dari total {{ $laporan->total() }} data
                    </div>
                    <div class="float-right mt-2">
                        {{ $laporan->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@include('laporan.cetak')
@include('laporan.preview')


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // === Handle Pilihan Rentang Tanggal ===
        const rangeSelect = document.getElementById('range');
        const customDateRange = document.getElementById('custom-date-range');

        rangeSelect.addEventListener('change', function () {
            if (this.value === 'custom') {
                customDateRange.classList.remove('d-none');
            } else {
                customDateRange.classList.add('d-none');
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
            }
        });

        // === Handle Tombol Pratinjau AJAX ===
        const btnPreview = document.getElementById('btn-preview');
        const previewBody = document.getElementById('preview-body');

        btnPreview.addEventListener('click', function () {
            const form = btnPreview.closest('form');
            const formData = new FormData(form);

            // Ambil nilai filter
            const range = form.querySelector('[name="range"]').value;
            const startDate = form.querySelector('[name="start_date"]').value;
            const endDate = form.querySelector('[name="end_date"]').value;
            const status = form.querySelector('[name="status"]').value;

            // Set ke form cetak PDF (hidden input)
            document.querySelector('#form-cetak-pdf input[name="range"]').value = range;
            document.querySelector('#form-cetak-pdf input[name="start_date"]').value = startDate;
            document.querySelector('#form-cetak-pdf input[name="end_date"]').value = endDate;
            document.querySelector('#form-cetak-pdf input[name="status"]').value = status;

            previewBody.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Memuat pratinjau...</p>
                </div>`;

            fetch("{{ route('laporan.cetak.preview') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                previewBody.innerHTML = html;
                $('#modal-preview').modal('show');
            })
            .catch(error => {
                previewBody.innerHTML = `<div class="alert alert-danger">Gagal memuat data.</div>`;
                console.error(error);
            });
        });
    });
</script>
@endpush


