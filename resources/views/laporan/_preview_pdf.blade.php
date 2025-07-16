<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman & Pengembalian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2, p {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>
        @if ($status === 'dipinjam')
            Laporan Peminjaman Buku
        @elseif ($status === 'sudah kembali')
            Laporan Pengembalian Buku
        @else
            Laporan Peminjaman & Pengembalian Buku
        @endif
    </h2>
    <p>
        Periode: {{ $tanggalDari }} s.d. {{ $tanggalSampai }}<br>
        Status: {{ $status === 'semua' ? 'Semua' : ucfirst($status) }}
    </p>

    <table>
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
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
