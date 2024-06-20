@extends('layout.welcome')

@section('title', 'Kategori')

@section('content')
        <div class="main-content">
          <section class="section">
            <div class="section-header">
              <h1>Kategori</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4 style="display: inline-block;">Kategori</h4>
                        <div class="card-header-form">
                            <form action="{{ route('kategori.index') }}" class="form-inline" method="GET">
                                <button class="btn btn-sm btn-success float-right" type="button" data-target="#modal-tambah" data-toggle="modal">Tambah Data</button>
                                <input type="search" name="search" id="search" class="form-control float-right ml-3"  placeholder="search" value="{{ request()->get('search') }}">
                                <div class='input-group-append'>
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>
                    

                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kategori as $key => $item)
                                    <td>{{$kategori->firstItem() + $key}}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        <form action="/kategori/{{$item->id}}" id="delete-form{{$item->id}}">
                                        @method('delete')
                                        <div style="white-space: nowrap;">
                                            <a href="/kategori/{{$item->id}}/edit" class="btn btn-sm btn-warning" style="display: inline-block;"><i class="fa fa-edit"></i> Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" style="display: inline-block;" onclick="confirmDelete('delete-form{{$item->id}}')"><i class="fa fa-trash"></i> Delete </button>
                                        </div>
                                        </form>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            Showing
                                {{ $kategori->firstItem() }}
                                to
                                {{ $kategori->lastItem() }}
                                of
                                {{ $kategori->total() }}
                                 entries


                        </div>
                        <div class="float-right">
                            {{ $kategori->links('pagination::bootstrap-4') }}
                        </div>                        
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('kategori.form')
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


