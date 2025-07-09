@extends('layout.welcome')

@section('title', 'Buku')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h4>Buku</h4>
            <a href="/buku/tambahbuku" class="btn btn-md btn-success" type="button">Tambah Buku</a>
        </div>
            <form action="{{ url('/buku') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan judul..." value="{{ request('keyword') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="kategori_id" class="form-control">
                            <option value="">-- Semua Kategori --</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->kode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ url('/buku') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

        <div class="section-body">
            <div class="container">
                <div class="row">
                    @foreach ($buku as $item)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card position-relative">
                            <a href="/buku/{{$item->id}}/detail">
                                <div class="img-container">
                                    <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                                </div>
                            </a>
                            <div class="card-body">
                                <p class="card-text"><strong>Nama Judul :</strong> {{ $item->judul }}</p>
                                <p class="card-text"><strong>ISBN :</strong> {{ $item->isbn }}</p>
                                <p class="card-text"><strong>Pengarang :</strong> {{ $item->pengarang }}</p>
                                <p class="card-text"><strong>Tahun Terbit :</strong> {{ $item->tahun_terbit }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>    
@endsection

@push('styles')
<style>
    .img-container {
        position: relative;
        width: 100%;
        padding-top: 133.33%; /* 4:3 aspect ratio */
        overflow: hidden;
    }

    .img-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
    position: absolute;
    bottom: -100%;
    left: 0;
    width: 100%;
    background-color: #000000; /* warna solid hitam */
    color: #fff; /* warna teks putih */
    transition: bottom 0.3s ease-in-out, opacity 0.3s ease-in-out;
    opacity: 0;
    padding: 15px;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
  



    .card:hover .card-body {
        bottom: 0;
        opacity: 1;
    }

    .card-text {
        margin-bottom: 5px;
    }
</style>
@endpush
