@extends('layout.welcome')

@section('title', 'Buku')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h4>Buku</h4>
            <a href="/buku/tambahbuku" class="btn btn-md btn-success" type="button">Tambah Buku</a>
        </div>

        <form action="{{ url('/buku') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan judul..." value="{{ request('keyword') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori_id" class="form-control">
                        <option value="">-- Semua Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->kode }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ url('/buku') }}" class="btn btn-secondary">Reset</a>
                    </div>
                    <span class="badge badge-info ml-2" style="font-size: 14px;">
                        Total Buku: {{ $totalBuku }}
                    </span>
                </div>
            </div>
        </form>

        <div class="section-body">
            <div class="container">
                @if ($kategoriBersertaBuku->isEmpty())
                    <div class="alert alert-warning mt-4">Tidak ada buku yang cocok dengan pencarian atau filter.</div>
                @endif
                @foreach ($kategoriBersertaBuku as $kat)
                    <h5 class="mt-4 mb-3">
                        <strong>Buku {{ $kat->kode }}</strong>
                        <span class="badge badge-info">{{ $kat->buku->count() }} Buku</span>
                    </h5>

                    @if ($kat->buku->isEmpty())
                        <p class="text-muted ml-3">Belum ada buku dalam kategori ini.</p>
                    @else
                        <div class="row">
                            @foreach ($kat->buku as $index => $item)
                                <div class="col-md-3 col-sm-6 mb-4 buku-item-{{ $kat->id }}" style="{{ $index >= 4 ? 'display: none;' : '' }}">
                                    <div class="card position-relative">
                                        <a href="/buku/{{ $item->id }}/detail">
                                            <div class="img-container">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Nama Judul :</strong> {{ $item->judul }}</p>
                                            <p class="card-text"><strong>ISBN :</strong> {{ $item->isbn }}</p>
                                            <p class="card-text"><strong>Pengarang :</strong> {{ $item->pengarang }}</p>
                                            <p class="card-text"><strong>Tahun Terbit :</strong> {{ $item->tahun_terbit }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($kat->buku->count() > 4)
                        <div class="col-12 mt-3">
                            <div class="book-toggle-bar d-flex align-items-center justify-content-between" data-kategori="{{ $kat->id }}">
                                <div class="toggle-more text-primary d-flex align-items-center" style="cursor: pointer;" data-kategori="{{ $kat->id }}" data-shown="4">
                                    <span class="mr-2">▼ Tampilkan lebih banyak</span>
                                </div>

                                <div class="flex-grow-1 border-top mx-3"></div>

                                <div class="toggle-less text-danger d-flex align-items-center" style="cursor: pointer; display: none;" data-kategori="{{ $kat->id }}">
                                    <span class="ml-2">▲ Tampilkan lebih sedikit</span>
                                </div>
                            </div>
                        </div>
                        @endif


                    @endif
                @endforeach
            </div>
        </div>

    </section>
</div>
@endsection

@push('styles')
<style>
    .img-container {
        position: relative;
        width: 100%;
        padding-top: 133.33%;
        overflow: hidden;
    }

    .img-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
        position: absolute;
        bottom: -100%;
        left: 0;
        width: 100%;
        background-color: #000;
        color: #fff;
        transition: bottom 0.3s ease-in-out, opacity 0.3s ease-in-out;
        opacity: 0;
        padding: 15px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .card:hover .card-body {
        bottom: 0;
        opacity: 1;
    }

    .card-text {
        margin-bottom: 5px;
    }

    .toggle-buku hr {
        border-top: 1px solid #007bff;
        margin: 0;
    }

    .toggle-buku {
        font-weight: bold;
        font-size: 14px;
    }
    .border-top {
        border-top: 2px solid #62b0ff !important;
        height: 0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-more').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const kategoriId = this.getAttribute('data-kategori');
            let shown = parseInt(this.getAttribute('data-shown'));
            const items = document.querySelectorAll(`.buku-item-${kategoriId}`);
            const total = items.length;
            const lessButton = document.querySelector(`.toggle-less[data-kategori="${kategoriId}"]`);

            let nextShown = Math.min(shown + 4, total);
            items.forEach((item, index) => {
                if (index < nextShown) {
                    item.style.display = 'block';
                }
            });

            this.setAttribute('data-shown', nextShown);

            if (nextShown >= total) {
                this.style.display = 'none';
                if (lessButton) lessButton.style.display = 'flex';
            }
        });
    });

    document.querySelectorAll('.toggle-less').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const kategoriId = this.getAttribute('data-kategori');
            const items = document.querySelectorAll(`.buku-item-${kategoriId}`);
            const moreButton = document.querySelector(`.toggle-more[data-kategori="${kategoriId}"]`);

            items.forEach((item, index) => {
                item.style.display = (index < 4) ? 'block' : 'none';
            });

            this.style.display = 'none';
            if (moreButton) {
                moreButton.style.display = 'flex';
                moreButton.setAttribute('data-shown', 4);
            }
        });
    });
});
</script>
@endpush
