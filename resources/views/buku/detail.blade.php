@extends('layout.welcome')

@section('title', 'Tambah Buku')

@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Detail Buku</h1>
        </div>
        </section>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Buku</h4>
                    <form action="/buku/{{$buku->id}}" method="POST" class="ml-auto" id="delete-form{{$buku->id}}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" style="font-size: 12px;" type="submit" onclick="confirmDelete('delete-form{{$buku->id}}')">Delete</button>
                    </form>
                </div>

                <div class="card-body">
                    <form action="/buku/{{$buku->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Photo Section -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        {{-- <div class="form-group">
                                            <label for="foto" style="font-size: 18px;">Foto</label>
                                            <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror" value="{{old('gambar')}}"
                                                   accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                        </div> --}}
                                        <!-- Display the preview image -->
                                        <img id="output" src="{{ asset('storage/' . $buku->gambar) }}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Form Fields Section -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="isbn" style="font-size: 18px;">ISBN</label>
                                            <div id="isbn" class="form-control" style="font-size: 16px;">{{$buku->isbn}}</div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="judul" style="font-size: 18px;">Judul</label>
                                            <div id="judul" class="form-control" style="font-size: 16px;">{{$buku->judul}}</div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="pengarang" style="font-size: 18px;">Pengarang</label>
                                            <div id="pengarang" class="form-control" style="font-size: 16px;">{{$buku->pengarang}}</div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="kategori" style="font-size: 18px;">Kategori</label>
                                            <div id="kategori" class="form-control" style="font-size: 16px;">
                                                {{ $buku->kategori->kode ?? 'Tidak ada kategori' }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Additional Details Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="jumlah_halaman" style="font-size: 18px;">Jumlah Halaman</label>
                                            <div id="jumlah_halaman" class="form-control" style="font-size: 16px;">{{$buku->jumlah_halaman}}</div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="stok" style="font-size: 18px;">Stok</label>
                                            <div id="stok" class="form-control" style="font-size: 16px;">{{$buku->stok}}</div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="tahun_terbit" style="font-size: 18px;">Tahun Terbit</label>
                                            <div id="tahun_terbit" class="form-control" style="font-size: 16px;">{{$buku->tahun_terbit}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sinopsis" style="font-size: 18px;">Sinopsis</label>
                                            <div id="sinopsis" class="form-control sinopsis-text" style="text-align: justify; height: 200px; overflow-y: auto;">{{$buku->sinopsis}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-between" style="margin-top: 10px;">
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning" style="font-size: 17px;">
                            Edit
                        </a>

                            <button class="btn btn-sm btn-secondary" style="font-size: 17px;" type="button" onclick="history.back()">Batal</button>
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
            title: 'Apakah anda yakin?',
            text: 'Ketika anda tekan OK maka data tidak dapat dikembalikan!',
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
