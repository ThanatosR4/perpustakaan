@extends('layout.welcome')

@section('title', 'Pengembalian')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4>Pengembalian Buku</h4>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4 style="display: inline-block;">Data Pengembalian Buku</h4>
                    </div>
                      
        
                      <div class="card-body">
                          <table class="table table-stripped">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">No.</th>
                                      <th>Nama Siswa</th>
                                      <th>Kelas</th>
                                      <th>Jenis Kelamin</th>
                                      <th>NISN</th>
                                      <th>Email</th>
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
                                </tr>
                              </tbody>
                          </table>                     
                      </div>
                  </div>
              </div>
                
            </div>
        </section>
    </div>    
@endsection