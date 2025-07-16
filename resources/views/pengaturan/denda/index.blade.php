@extends('layout.welcome')

@section('title', 'Pengaturan Denda')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Denda Keterlambatan</h1>
        </div>

        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pengaturan.denda.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="denda_per_hari">Denda Per Hari (Rp)</label>
                    <input type="number" name="denda_per_hari" class="form-control" value="{{ old('denda_per_hari', $pengaturan->denda_per_hari ?? '') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </form>
        </div>
    </section>
</div>
@endsection
