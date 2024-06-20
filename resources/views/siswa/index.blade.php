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
                <h4 style="display: inline-block;">Daftar Siswa</h4>
                <div class="card-header-form" style="display: flex; justify-content: flex-end; align-items: center;">
                    <button class="btn btn-sm btn-success" type="button" data-target="#modal-tambah" data-toggle="modal">Tambah Siswa</button>
                    <form action="{{ route('siswa.index') }}" method="GET" class="form-inline" style="margin-right: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-left float-right ml-4" placeholder="Cari siswa..." name="search" value="{{ request()->get('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default rounded-right"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
              

              <div class="card-body">
                  <table class="table table-stripped">
                      <thead>
                          <tr>
                              <th style="width: 5%">No.</th>
                              <th>Nama Siswa</th>
                              <th>Kelas</th>
                              <th>Jenis Kelamin</th>
                              <th>NISN</th>
                              <th>Email</th>
                              <th style="width: 19%">Aksi</th>
                          </tr>
                      </thead>

                      <tbody>
                        @foreach ($siswa as $key=> $item)
                        <tr>
                            <td>{{$siswa->firstItem() + $key}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->kelas}}</td>
                                <td>
                                    @if($item->jenis_kelamin == 'L')
                                        <button class="btn btn-primary" disabled>
                                              {{$item->jenis_kelamin}}
                                          </button>
                                      @else
                                          <button class="btn btn-danger" disabled>
                                            {{$item->jenis_kelamin}}
                                         </button>
                                     @endif
                                </td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <button class="btn btn-sm btn-info" data-target="#modal-detail-{{$item->id}}" data-toggle="modal"><i class="fa fa-info"></i> Detail</button>
                                    <!-- Tombol Edit -->
                                    <a href="/siswa/{{$item->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>

                                    <!-- Tombol Delete -->
                                    <form action="/siswa/{{$item->id}}" method="POST" id="delete-form{{$item->id}}" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-danger" style="display: inline-block;" onclick="confirmDelete('delete-form{{$item->id}}')"><i class="fa fa-trash"></i> Delete </button>
                                    </form>
                                           
                                </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <div>
                    Showing
                        {{ $siswa->firstItem() }}
                        to
                        {{ $siswa->lastItem() }}
                        of
                        {{ $siswa->total() }}
                         entries


                </div>
                <div class="float-right">
                    {{ $siswa->links('pagination::bootstrap-4') }}
                </div>                      
                  
              </div>
          </div>
      </div>
  </section>
</div>
@include('siswa.detail')
@include('siswa.form')
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
