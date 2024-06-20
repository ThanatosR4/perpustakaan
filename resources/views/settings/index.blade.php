@extends('layout.welcome')

@section('title', 'Settings')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Settings</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Settings</div>
        </div>
      </div>

      <div class="section-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="card-body text-right">
                    <h4>General</h4>
                    <p>General settings such as, site title, site description, address and so on.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-body text-right">
                    <h4>Account</h4>
                    <p>Account settings, profile information, and other related settings.</p>
                    <a href="/settings/{{auth()->user()->id}}/akun" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="card-body text-right">
                    <h4>Profile</h4>
                    <p>Profile settings, personal information, and other related settings.</p>
                    <a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        
    </div>
</div>

    </section>
  </div> 
@endsection