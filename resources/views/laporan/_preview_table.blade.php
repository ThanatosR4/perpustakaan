@if ($laporan->isEmpty())
    <div class="alert alert-info">Tidak ada data untuk rentang waktu dan status yang dipilih.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Lama</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->siswa->kode }}</td>
                        <td>{{ $item->siswa->nama }}</td>
                        <td>{{ $item->buku->judul ?? '-' }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->lama_pinjam }} hari</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->addDays($item->lama_pinjam)->format('Y-m-d') }}</td>
                        <td>
                            @if ($item->status == 'dipinjam')
                                <span class="badge badge-warning">Dipinjam</span>
                            @else
                                <span class="badge badge-success">Sudah Kembali</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
