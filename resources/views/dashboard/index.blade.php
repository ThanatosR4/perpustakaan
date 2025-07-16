@extends('layout.welcome')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Admin</h1>
        </div>

        <div class="section-body">

            <!-- Statistik Kartu -->
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Jumlah Siswa</h4></div>
                            <div class="card-body">{{ $totalSiswa }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Total Buku</h4></div>
                            <div class="card-body">{{ $totalBuku }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Peminjaman Hari Ini</h4></div>
                            <div class="card-body">{{ $peminjamanHariIni }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Buku Sedang Dipinjam</h4></div>
                            <div class="card-body">{{ $bukuDipinjam }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengembalian Hari Ini -->
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h4 class="mb-0">Pengembalian Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <h5>{{ $pengembalianHariIni }} buku dikembalikan hari ini.</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Bulanan -->
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Peminjaman Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafikPeminjaman" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Terbaru -->
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Peminjaman Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse ($peminjamanTerbaru as $pinjam)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $pinjam->nama }}</strong> meminjam <em>{{ $pinjam->buku->judul ?? 'Buku tidak ditemukan' }}</em>
                                            <br>
                                            <small>{{ $pinjam->tanggal_pinjam }}</small>
                                        </div>
                                        <span class="badge badge-{{ $pinjam->status === 'dipinjam' ? 'danger' : 'success' }}">{{ ucfirst($pinjam->status) }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center">Belum ada data peminjaman</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Akses Cepat -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Akses Cepat</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary mr-2"><i class="fas fa-users"></i> Data Siswa</a>
                            <a href="{{ route('buku.index') }}" class="btn btn-outline-success mr-2"><i class="fas fa-book"></i> Data Buku</a>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-warning mr-2"><i class="fas fa-book-reader"></i> Peminjaman</a>
                            <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-info"><i class="fas fa-undo"></i> Pengembalian</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lokasi Sekolah -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="m-0">Lokasi Sekolah (SMA Negeri 1 Teluk Keramat)</h6>
                </div>
                <div class="card-body text-center">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6707.859112556008!2d109.22255839314413!3d1.463467500769663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31e4c1b236e19725%3A0xa0277c84fc793ed4!2sSMA%20Negeri%201%20Teluk%20Keramat!5e0!3m2!1sid!2sid!4v1717445323563!5m2!1sid!2sid" 
                        width="100%" 
                        height="350" 
                        style="border:0;" 
                        allowfullscreen 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikPeminjaman').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($grafik)) !!},
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: {!! json_encode(array_values($grafik)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
