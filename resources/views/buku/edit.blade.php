@extends('layout.welcome')

@section('title', 'Edit Buku')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Buku</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Edit Buku</h4>
                <form action="/buku/{{ $buku->id }}" method="POST" class="ml-auto" id="delete-form{{ $buku->id }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger" type="submit" onclick="confirmDelete('delete-form{{ $buku->id }}')">Hapus</button>
                </form>
            </div>

            <div class="card-body">
                <form action="/buku/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Gambar -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <label>Foto Buku</label>
                                    <input type="file" name="gambar" class="form-control-file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                    <img id="output" src="{{ asset('storage/' . $buku->gambar) }}" class="img-fluid mt-3" style="max-height: 300px;">
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Buku -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ISBN</label>
                                        <input type="text" name="isbn" class="form-control" value="{{ $buku->isbn }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengarang</label>
                                        <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori_id" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}" {{ $buku->kategori_id == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->kode }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Tambahan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Jumlah Halaman</label>
                                        <input type="number" name="jumlah_halaman" class="form-control" value="{{ $buku->jumlah_halaman }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Terbit</label>
                                        <input type="text" name="tahun_terbit" class="form-control" value="{{ $buku->tahun_terbit }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sinopsis</label>
                                        <textarea name="sinopsis" class="form-control" rows="5" style="text-align: justify;">{{ $buku->sinopsis }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(formId){
        event.preventDefault();
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush
