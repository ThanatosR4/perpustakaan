@extends('layout.welcome')

@section('title', 'Edit Data Kategori')

@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Kategori</h4>
                </div>

                <div class="card-body">
                    <form action="/kategori/{{$kategori->id}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="from-group">
                            <label for="kode">Kode</label>
                            <input type="text" name="kode" id="kode" class="form-control" value="{{$kategori->kode}}">
                        </div>
            
                        <div class="from-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{$kategori->nama}}">
                        </div>
                        <div class="d-flex justify-content-between" style="margin-top: 10px;">
                            <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                            <button class="btn btn-sm btn-secondary" type="button" onclick="history.back()">Batal</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
        </section>
    </div>
@endsection
