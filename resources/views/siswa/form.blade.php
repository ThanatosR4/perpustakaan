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
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="kode">NISN</label>
                <input type="number" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror"
                    value="{{ old('kode') }}" @error('kode') autofocus @enderror>
                @error('kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="from-group" style="margin-bottom: 15px;">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px; position: relative;">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control">
              <span id="togglePassword" style="position: absolute; right: 15px; top: 35px; cursor: pointer;">
                  &#128065;
              </span>
          </div>
          
          <div class="form-group" style="margin-bottom: 15px; position: relative;">
              <label for="password_confirmation">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
              <span id="togglePasswordConfirmation" style="position: absolute; right: 15px; top: 35px; cursor: pointer;">
                  &#128065;
              </span>
              <span id="password-match-icon" style="position: absolute; right: 35px; top: 35px; color: red; display: none;">&#10006;</span>
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
                <input type="number" name="telepon" id="telepon" class="form-control">
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

  <script>
    const passwordField = document.getElementById('password');
    const passwordConfirmationField = document.getElementById('password_confirmation');
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordMatchIcon = document.getElementById('password-match-icon');

    togglePassword.addEventListener('click', function() {
        // Toggle password visibility
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        // Toggle icon (optional: change icon here if needed)
        this.innerHTML = type === 'password' ? '&#128065;' : '&#128065;'; // You can replace with different icons
    });

    togglePasswordConfirmation.addEventListener('click', function() {
        // Toggle password confirmation visibility
        const type = passwordConfirmationField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmationField.setAttribute('type', type);
        
        // Toggle icon (optional: change icon here if needed)
        this.innerHTML = type === 'password' ? '&#128065;' : '&#128065;'; // You can replace with different icons
    });

    passwordConfirmationField.addEventListener('input', function() {
        if (passwordField.value !== passwordConfirmationField.value) {
            passwordMatchIcon.style.display = 'inline';
        } else {
            passwordMatchIcon.style.display = 'none';
        }
    });
</script>


<style>
  #togglePassword, #togglePasswordConfirmation {
      position: absolute;
      right: 15px;
      top: 35px;
      cursor: pointer;
      font-size: 18px;
  }

  #password-match-icon {
      position: absolute;
      right: 35px; /* Adjusted to make room for the toggle icon */
      top: 35px;
      font-size: 18px;
  }
</style>

@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#modal-tambah').modal('show');
    });
</script>
@endif