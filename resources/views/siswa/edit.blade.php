@extends('layout.welcome')

@section('title', 'Siswa')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Daftar Siswa</h1>
      </div>

      <div class="section-body">
          <div class="card">
              <div class="card-header">
                  <h4 style="display: inline-block;">Edit Siswa</h4>
              </div>

              <div class="card-body" style="margin-bottom: 15px;">
                <form action="/siswa/{{$siswa->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="kode">NISN</label>
                        <input type="text" name="kode" id="kode" class="form-control"  value="{{$siswa->kode}}">
                    </div>
        
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{$siswa->nama}}">
                    </div>
        
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="X" {{ $siswa->kelas === 'X' ? 'selected' : '' }}>X</option>
                            <option value="XI" {{ $siswa->kelas === 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ $siswa->kelas === 'XII' ? 'selected' : '' }}>XII</option>
                        </select>
                    </div>
        
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="radio-group">
                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" {{ $siswa->jenis_kelamin === 'P' ? 'checked' : '' }}>
                            <label for="jenis_kelamin_p">Perempuan</label>
                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" {{ $siswa->jenis_kelamin === 'L' ? 'checked' : '' }}>
                            <label for="jenis_kelamin_l">Laki-laki</label>
                        </div>
                    </div>
                    
                    
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="nama">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{$siswa->tempat_lahir}}">
                    </div>
        
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{$siswa->tanggal_lahir}}">
                    </div>
        
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="nama">Telepon/No HP</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" value="{{$siswa->telepon}}">
                    </div>
        
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="nama">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$siswa->email}}">
                    </div>
                    
                    <div class="from-group" style="margin-bottom: 15px;">
                        <label for="nama">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{$siswa->alamat}}">
                    </div>
        
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" value="{{old('foto')}}"
                               accept="images/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    
                    <!-- Tambahkan elemen gambar untuk menampilkan pratinjau -->
                    <img id="output" src="{{asset($siswa->foto)}}" style="margin-top: 15px; max-width: 200px; max-height: 200px; height: auto;">

        
                    {{-- <div class="from-group">
                        <label for="nama">crated_at</label>
                        <input type="text" name="crated_at" id="crated_at" class="form-control">
                    </div>
        
                    <div class="from-group">
                        <label for="nama">updated_at</label>
                        <input type="text" name="updated_at" id="updated_at" class="form-control">
                    </div> --}}
        
        
        
        
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
@include('siswa.form')
@endsection