@extends('layout.welcome')

@section('title', 'Account Settings')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Account Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item">Account Settings</div>
            </div>
        </div>

        <div class="section-body">
            <div id="output-status"></div>
            <div class="row">
                <div class="col-md-8">
                    <form id="setting-form" action="{{ route('settings.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>Account Settings</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Silahkan edit data sesuai kebutuhan</p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Username</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="name" name="name" class="form-control" id="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Email</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                {{-- <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Password</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                </div> --}}
                                <div class="form-group row align-items-center">
                                    <div class="col-sm-6 col-md-9 offset-sm-3">
                                        <button type="button" class="btn btn-secondary" onclick="togglePasswordChange()">Change Password</button>
                                    </div>
                                </div>
                                <div id="password-change-section" style="display: none;">
                                    <div class="form-group row align-items-center">
                                        <label for="old-password" class="form-control-label col-sm-3 text-md-right">Old Password</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="password" name="old_password" class="form-control" id="old-password">
                                          </div>
                                          
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="new-password" class="form-control-label col-sm-3 text-md-right">New Password</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="password" name="new_password" class="form-control" id="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="confirm-password" class="form-control-label col-sm-3 text-md-right">Confirm New Password</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" id="confirm-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-control-label col-sm-3 mt-3 text-md-right">Deskripsi</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control" name="description">{{ $user->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Foto</label>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="custom-file">
                                            <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" value="{{old('foto')}}"
                                               accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                                    </div>
                                    <div class="col-md-3">
                                        <img id="output" src="" style="max-width: 200px; max-height: 200px; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" id="save-btn">Simpan Perubahan</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>  

<script>
    function togglePasswordChange() {
        var section = document.getElementById('password-change-section');
        if (section.style.display === 'none') {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    }
</script>

@endsection
