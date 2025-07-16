@extends('layout.welcome')

@section('title', 'Log Aktivitas')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Log Aktivitas</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block;">Daftar Aktivitas</h4>
                    <div class="card-header-form">
                        <form action="{{ route('aktivitas.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control float-right ml-2" placeholder="Cari aksi / pengguna..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default ml-2"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Aksi</th>
                                <th>Keterangan</th>
                                <th>Pengguna</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($aktivitas as $key => $item)
                                <tr>
                                    <td>{{ $aktivitas->firstItem() + $key }}</td>
                                    <td><span class="badge badge-info">{{ $item->aksi }}</span></td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                                    <td>{{ $item->created_at->translatedFormat('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada aktivitas tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        Menampilkan {{ $aktivitas->firstItem() }} - {{ $aktivitas->lastItem() }} dari total {{ $aktivitas->total() }} data
                    </div>

                    <div class="float-right">
                        {{ $aktivitas->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
