<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/kategori/store" method="POST">
            @csrf
            <div class="from-group">
                <label for="kode">Kode</label>
                <input type="text" name="kode" id="kode" class="form-control">
            </div>

            <div class="from-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>


            <button class="btn btn-sm btn-success" type="submit" style="margin-top: 10px;">Simpan</button>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>