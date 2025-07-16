<div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-eye"></i> Pratinjau Laporan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="preview-body">
                <!-- AJAX content will be injected here -->
            </div>

            <div class="modal-footer justify-content-end">
                <form id="form-cetak-pdf" action="{{ route('laporan.cetak.pdf') }}" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" name="range">
                    <input type="hidden" name="start_date">
                    <input type="hidden" name="end_date">
                    <input type="hidden" name="status">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
