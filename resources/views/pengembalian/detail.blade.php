@foreach ($pengembalian as $item)
<div class="modal fade" id="modal-detail-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Pengembalian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Siswa:</strong> {{ $item->pinjaman->nama ?? '-' }}</p>
                <p><strong>NISN:</strong> {{ $item->pinjaman->siswa->kode ?? '-' }}</p>
                <p><strong>Kelas:</strong> {{ $item->pinjaman->siswa->kelas ?? '-' }}</p>
                <p><strong>Judul Buku:</strong> {{ $item->pinjaman->buku->judul ?? '-' }}</p>
                <p><strong>Pengarang:</strong> {{ $item->pinjaman->buku->pengarang ?? '-' }}</p>
                <p><strong>Tanggal Pinjam:</strong> {{ $item->pinjaman->tanggal_pinjam ?? '-' }}</p>
                <p><strong>Tanggal Kembali:</strong> {{ $item->tanggal_kembali ?? '-' }}</p>
                <p><strong>Keterangan:</strong> {{ $item->pinjaman->keterangan ?? '-' }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

