<div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="modalPrintLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('pengembalian.print') }}" method="GET" target="_blank">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPrintLabel">
                        <i class="fas fa-print"></i> Cetak Data Pengembalian
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Silakan pilih rentang waktu pengembalian yang ingin dicetak:</p>

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
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak Sekarang
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
