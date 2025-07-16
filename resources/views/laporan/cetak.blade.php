<div class="modal fade" id="modal-cetak" tabindex="-1" role="dialog" aria-labelledby="modalCetakLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('laporan.cetak.preview') }}" method="POST" target="_blank">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCetakLabel">
                        <i class="fas fa-print"></i> Cetak Laporan Peminjaman & Pengembalian
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Silakan pilih filter untuk mencetak laporan:</p>

                    <div class="form-group">
                        <label for="range">Rentang Waktu</label>
                        <select name="range" id="range" class="form-control">
                            <option value="7">7 Hari Terakhir</option>
                            <option value="30">30 Hari Terakhir</option>
                            <option value="custom">Rentang Tanggal Khusus</option>
                        </select>
                    </div>

                    <div id="custom-date-range" class="row d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Dari Tanggal</label>
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Status Peminjaman</label>
                        <select name="status" id="status" class="form-control">
                            <option value="semua">Semua</option>
                            <option value="dipinjam">Sedang Dipinjam</option>
                            <option value="sudah kembali">Sudah Dikembalikan</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-preview" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-search"></i> Tampilkan Pratinjau
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
