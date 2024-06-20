<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/siswa/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="from-group" style="margin-bottom: 15px;">
                <label for="kode">NISN</label>
                <input type="text" name="kode" id="kode" class="form-control">
            </div>

            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="kelas">Kelas</label>
                <select name="kelas" id="kelas" class="form-control">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P">
                    <label for="jenis_kelamin_p">Perempuan</label>
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L">
                    <label for="jenis_kelamin_l">Laki-laki</label>
                </div>
            </div>
            
            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
            </div>

            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Telepon/No HP</label>
                <input type="text" name="telepon" id="telepon" class="form-control">
            </div>

            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            
            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" value="{{old('foto')}}"
                       accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
            </div>
            
            <!-- Tambahkan elemen gambar untuk menampilkan pratinjau -->
            <img id="output" src="" style="margin-top: 15px; max-width: 200px; max-height: 200px; height: auto;">

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
                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal" >Batal</button>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>