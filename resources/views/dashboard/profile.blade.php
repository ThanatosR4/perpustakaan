@extends('layout.welcome')

@section('title', 'Profile')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      
      <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5"> 
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ asset(auth()->user()->foto) }}" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Total Siswa</div>
                                <div class="profile-widget-item-value">{{ $siswaCount }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Total Buku</div>
                                <div class="profile-widget-item-value">{{ $bukuCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{auth()->user()->name}} <div class="text-muted d-inline font-weight-normal"><div></div></div></div>
                        @if(auth()->user()->description)
                            <p>{{ auth()->user()->description }}</p>
                        @endif
                    </div>
                    <div class="profile-widget-description">
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Location: SMA Negeri 1 Teluk Keramat, Indonesia</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                      </div>
                      <div class="embed-responsive embed-responsive-16by9 mt-3">
                        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6707.859112556008!2d109.22255839314413!3d1.463467500769663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31e4c1b236e19725%3A0xa0277c84fc793ed4!2sSMA%20Negeri%201%20Teluk%20Keramat!5e0!3m2!1sid!2sid!4v1717445323563!5m2!1sid!2sid" width="500" height="700" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
              
    </div>
    

    </section>
  </div>   
@endsection