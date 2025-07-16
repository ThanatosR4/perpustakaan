@extends('layout.welcome')

@section('title', 'Siswa')


@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Siswa</h1>
        </div>

        <div class="section-body">
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Siswa</h4>

                    <div class="d-flex align-items-center">
                        <!-- Filter kelas -->
                        <form action="{{ route('siswa.index') }}" method="GET" class="form-inline mr-3">
                            <select name="kelas" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Kelas</option>
                                <option value="X" {{ request('kelas') == 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ request('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ request('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                        </form>

                        <!-- Search -->
                        <form action="{{ route('siswa.index') }}" method="GET" class="form-inline">
                            <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari siswa..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <a href="#" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#modal-tambah">Tambah Siswa</a>
                    </div>
                </div>

                @if(request('kelas'))
                    <div class="px-4 pb-2">
                        <span class="badge badge-info">Menampilkan Kelas {{ request('kelas') }}</span>
                    </div>
                @endif

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index => $item)
                                <tr>
                                    <td>{{ $siswa->firstItem() + $index }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>
                                        @if($item->jenis_kelamin == 'L')
                                            <span class="badge badge-primary">L</span>
                                        @else
                                            <span class="badge badge-danger">P</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-{{ $item->id }}">Detail</button>
                                        <a href="/siswa/{{ $item->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="/siswa/{{ $item->id }}" method="POST" id="delete-form{{ $item->id }}" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form{{ $item->id }}')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} dari total {{ $siswa->total() }} data
                    </div>

                    <div class="float-right">
                        {{ $siswa->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('siswa.form')
@include('siswa.detail')
@endsection

@push('scripts')
<script>
    function confirmDelete(formId){
        event.preventDefault();
        swal({
            title: 'Apakah anda yakin?',
            text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
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
