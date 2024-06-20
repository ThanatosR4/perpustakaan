@extends('layout.welcome')

@section('title', 'Peminjaman')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4>Peminjaman Buku</h4>
            </div>

            <div class="card-header-form">
                
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4 style="display: inline-block;">Data Peminjaman Buku</h4>
                        <form action="#" method="GET" class="form-inline">
                            <div class="input-group">
                                <!-- Pilihan Bulan -->
                                <select class="form-control" name="month">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                    
                                <!-- Pilihan Tahun -->
                                <select class="form-control" name="year">
                                    @php
                                    $currentYear = date('Y');
                                    @endphp
                                    @for ($i = $currentYear; $i >= $currentYear - 10; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                    
                                <!-- Tombol Cari -->
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                    
                            <!-- Tombol Refresh dan Print -->
                            <div class="input-group ml-3">
                                <button class="btn btn-success" type="button" onclick="window.location.reload();">Refresh</button>
                                <button class="btn btn-info ml-2" type="button" onclick="window.print();">Print</button>
                            </div>
                        </form>
                    </div>
                
                      <div class="card-body">
                          <table class="table table-stripped">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">No.</th>
                                      <th>No Pinjam</th>
                                      <th>NISN</th>
                                      <th>Nama</th>
                                      <th>Pinjam</th>
                                      <th>Balik</th>
                                      <th>Dipinjam</th>
                                      <th>Denda</th>
                                      <th style="width: 19%">Aksi</th>
                                  </tr>
                              </thead>
        
                              <tbody>
                                <tr>
                                    <td>12</td>
                                        <td>1</td>
                                        <td>asdas</td>
                                        <td>12</td>
                                        <td>3</td>
                                        <td>321</td>
                                        <td>3123</td>
                                        <td>3123</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">Dikembalikan</button>
                                            <button class="btn btn-info btn-sm">Detail</button>
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </td>
                                </tr>
                              </tbody>
                          </table>                     
                      </div>
                  </div>
              </div>
                
            </div>
                
            </div>
        </section>
    </div>    
@endsection