@extends('layout.welcome')

@section('title', 'Tambah Buku')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Buku</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form action="/buku" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" style="font-size: 16px; height: auto;">
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                            <label for="kategori_id" style="font-size: 18px;">Kode</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" style="font-size: 16px;" onchange="setKode()">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" data-kode="{{ $k->nama }}">{{ $k->kode }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control" style="font-size: 16px; height: auto;">
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Penerbit</label>
                                <input type="text" name="penerbit_id" id="penerbit_id" class="form-control" style="font-size: 16px; height: auto;">
                            </div>


                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Jumlah Halaman</label>
                                <input type="text" name="jumlah_halaman" id="jumlah_halaman" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Stok</label>
                                <input type="text" name="stok" id="stok" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Sinopsis</label>
                                <input type="text" name="sinopsis" id="sinopsis" class="form-control" style="font-size: 16px; height: auto; width: 100%;">
                            </div>
                                                        
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="foto" style="font-size: 18px;">Foto</label>
                                <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror" value="{{old('gambar')}}"
                                       accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            
                            <img id="output" src="" style="margin-top: 15px; max-width: 200px; max-height: 200px; height: auto;">
                            
                           
                             <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                <button class="btn btn-sm btn-success" style="font-size: 12px;" type="submit">Simpan</button>
                                <button class="btn btn-sm btn-secondary" style="font-size: 12px;" type="button" onclick="history.back()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection








 {{-- @extends('layout.welcome')

@section('title', 'Tambah Buku')

@section('content')
        <div class="main-content">
            <section class="section">
            <div class="section-header">
                <h1>Tambah Buku</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                      <div class="card-body">
                            <form action="/siswa/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" style="font-size: 16px; height: auto;">
                            </div>
                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Kode</label>
                                <input type="text" name="kode" id="kode" class="form-control" style="font-size: 16px; height: auto;">
                            </div>
                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Jumlah Halaman</label>
                                <input type="text" name="jumlah_halaman" id="jumlah_halaman" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Stok</label>
                                <input type="text" name="stok" id="stok" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="from-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" style="font-size: 16px; height: auto;">
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="nama" style="font-size: 18px;">Sinopsis</label>
                                <input type="text" name="sinopsis" id="sinopsis" class="form-control" style="font-size: 16px; height: auto; width: 100%;">
                            </div>
                                                        

                            {{-- <div class="form-group" style="margin-bottom: 15px;">
                                <label for="foto" style="font-size: 18px;">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" value="{{old('foto')}}"
                                       accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            
                            <!-- Tambahkan elemen gambar untuk menampilkan pratinjau -->
                            <img id="output" src="" style="margin-top: 15px; max-width: 200px; max-height: 200px; height: auto;">
                             --}}
                             {{-- <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                <button class="btn btn-sm btn-success" style="font-size: 12px;" type="submit">Simpan</button>
                                <button class="btn btn-sm btn-secondary" style="font-size: 12px;" type="button" onclick="history.back()">Batal</button>
                            </div>
                            </form>
                        
                      </div>
                  </div>
              </div>
            </div>
            </section>
        </div>

@endsection  --}}