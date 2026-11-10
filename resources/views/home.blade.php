@extends('layouts.master')

@section('title', 'Dashboard Utama')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="mb-4">
            <h3 class="fw-bold text-primary mb-1">
                <i class="fa-solid fa-gauge me-2"></i>Dashboard Utama Admin
            </h3>
            <p class="text-muted mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>! Anda telah berhasil login ke Sistem Pengelolaan Berita & Isu serta Portal Lowongan Kerja.</p>
        </div>

        <hr class="my-4 text-secondary opacity-25">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border rounded-3 bg-light shadow-sm">
                    <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fa-solid fa-newspaper fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Data Berita</h5>
                            <p class="small text-muted mb-3">Kelola publikasi berita dan isu terkini secara dinamis.</p>
                        </div>
                        <a href="{{ route('berita.index') }}" class="btn btn-primary w-100 fw-semibold rounded-pill">
                            Kelola Berita <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->level == 'admin')
            <div class="col-md-4">
                <div class="card h-100 border rounded-3 bg-light shadow-sm">
                    <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fa-solid fa-briefcase fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Lowongan Kerja</h5>
                            <p class="small text-muted mb-3">Kelola data lowongan pekerjaan dan logo perusahaan.</p>
                        </div>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary w-100 fw-semibold rounded-pill">
                            Kelola Lowongan <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border rounded-3 bg-light shadow-sm">
                    <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fa-solid fa-users-gear fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Manajemen Users</h5>
                            <p class="small text-muted mb-3">Kelola hak akses dan tingkat otorisasi pengguna sistem.</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="btn btn-primary w-100 fw-semibold rounded-pill">
                            Kelola Users <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection