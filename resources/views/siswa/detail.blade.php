@foreach ($siswa as $item)
<div class="modal fade" id="modal-detail-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{$item->id}}">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-md-4 text-center">
                            <!-- Foto Profil -->
                            <div class="photo-container-3x4">
                                <img src="{{ asset($item->foto) }}" alt="Foto Profil" class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <!-- Nama dan NISN -->
                            <p class="h6 mb-3"><strong>Nama:</strong> {{$item->nama}}</p>
                            <p class="h6 mb-3"><strong>NISN:</strong> {{$item->kode}}</p>
                            <p class="h6 mb-3"><strong>Kelas:</strong> {{$item->kelas}}</p>
                            <p class="h6 mb-3"><strong>Jenis Kelamin:</strong> {{$item->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}}</p>
                            <p class="h6 mb-3"><strong>Tempat Lahir:</strong> {{$item->tempat_lahir}}</p>
                            <p class="h6 mb-3"><strong>Tanggal Lahir:</strong> {{$item->tanggal_lahir}}</p>
                            <p class="h6 mb-3"><strong>Telepon:</strong> {{$item->telepon}}</p>
                            <p class="h6 mb-3"><strong>Email:</strong> {{$item->email}}</p>
                            <p class="h6 mb-3"><strong>Alamat:</strong> {{$item->alamat}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Detail Pinjaman -->
            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .photo-container-3x4 {
        width: 100%;
        padding-bottom: 133.33%; /* 3:4 aspect ratio */
        position: relative;
        overflow: hidden; /* Ensure content outside container is hidden */
    }
    .photo-container-3x4 img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Cover the container while maintaining aspect ratio */
    }
</style>



