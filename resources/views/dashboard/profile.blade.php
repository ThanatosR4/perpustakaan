@extends('layout.welcome')

@section('title', 'Profil Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h4>Profil Admin</h4>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default-avatar.png') }}" 
                                 alt="Foto Profil" 
                                 class="img-thumbnail rounded-circle mb-3" 
                                 width="150">

                            <h5 class="mb-0">{{ $user->name }}</h5>
                            <p class="text-muted mb-1">{{ $user->email }}</p>
                            <span class="badge badge-info">Admin Perpustakaan</span>
                            <p class="mt-3">Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>

                            {{-- Deskripsi Admin --}}
                            @if($user->description)
                                <div class="mt-4 text-left">
                                    <h6>Deskripsi</h6>
                                    <p class="text-muted">{{ $user->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
