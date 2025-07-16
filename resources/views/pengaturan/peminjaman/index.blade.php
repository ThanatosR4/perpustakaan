@extends('layout.welcome')

@section('title', 'Pengaturan Peminjaman')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Aturan Peminjaman</h1>
        </div>

        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pengaturan.peminjaman.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="maksimal_hari">Maksimal Hari Peminjaman</label>
                    <input type="number" name="maksimal_hari" class="form-control" value="{{ old('maksimal_hari', $pengaturan->maksimal_hari) }}" required>
                </div>
                <div class="form-group">
                    <label for="maksimal_buku">Maksimal Jumlah Buku</label>
                    <input type="number" name="maksimal_buku" class="form-control" value="{{ old('maksimal_buku', $pengaturan->maksimal_buku) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </form>
        </div>
    </section>
</div>
@endsection
