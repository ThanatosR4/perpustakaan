@foreach ($pinjaman as $item)
<div class="modal fade" id="modal-detail-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{$item->id}}">Detail Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Siswa:</strong> {{ $item->nama }}</p>
                <p><strong>NISN:</strong> {{ $item->siswa->kode ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $item->siswa->email ?? '-' }}</p>
                <p><strong>Judul Buku:</strong> {{ $item->buku->judul ?? '-' }}</p>
                <p><strong>Pengarang:</strong> {{ $item->buku->pengarang ?? '-' }}</p>
                <p><strong>Tanggal Pinjam:</strong> {{ $item->tanggal_pinjam }}</p>
                <p><strong>Lama Pinjam:</strong> {{ $item->lama_pinjam }} hari</p>
                <p><strong>Tanggal Kembali:</strong> {{ $item->tanggal_kembali }}</p>
                <p><strong>Status:</strong>
                    @if($item->status === 'dipinjam')
                        <span class="badge badge-warning">Dipinjam</span>
                    @elseif($item->status === 'sudah kembali')
                        <span class="badge badge-success">Sudah Dikembalikan</span>
                    @endif
                </p>
                <p><strong>Keterangan:</strong> {{ $item->keterangan }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
