@extends('layout.welcome')

@section('title', 'Buku')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h4>Buku</h4>
            <a href="/buku/tambahbuku" class="btn btn-md btn-success" type="button">Tambah Buku</a>
        </div>

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
        background: rgba(255, 255, 255, 0.5); /* White background with 50% opacity */
        color: #000; /* Change text color to black for better readability */
        transition: bottom 0.3s ease-in-out, opacity 0.3s ease-in-out;
        opacity: 0;
        padding: 10px;
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
