@extends('layouts.master')

@section('title', 'Daftar Lowongan Kerja')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <!-- Header Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-primary mb-1">
                    <i class="fa-solid fa-briefcase me-2"></i>Daftar Lowongan Kerja
                </h3>
                <p class="text-muted mb-0">Menampilkan daftar seluruh lowongan pekerjaan beserta detail perusahaan.</p>
            </div>
            <a href="{{ route('jobs.create') }}" class="btn btn-success fw-semibold">
                <i class="fa-solid fa-plus me-1"></i> Tambah Lowongan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tampilan Card Lowongan Kerja (Responsive Grid) -->
        <div class="row">
            @forelse($jobs as $job)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                @if($job->logo)
                                    <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo" class="rounded-3 me-3 object-fit-cover border" width="55" height="55">
                                @else
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center text-secondary border" style="width: 55px; height: 55px;">
                                        <i class="fa-solid fa-building fs-4"></i>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="fw-bold mb-0 text-primary">{{ $job->title }}</h5>
                                    <small class="text-muted fw-semibold">{{ $job->company }}</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="badge bg-info text-dark rounded-pill me-1">
                                    <i class="fa-solid fa-clock me-1"></i>{{ $job->type }}
                                </span>
                                <span class="badge bg-secondary rounded-pill">
                                    <i class="fa-solid fa-location-dot me-1"></i>{{ $job->location }}
                                </span>
                            </div>

                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($job->description, 90) }}
                            </p>

                            <div class="fw-bold text-success mb-3">
                                @if($job->salary)
                                    <i class="fa-solid fa-money-bill-wave me-1"></i>Rp {{ number_format($job->salary, 0, ',', '.') }}
                                @else
                                    <span class="text-muted fst-italic">Gaji tidak ditampilkan</span>
                                @endif
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning text-dark fw-semibold w-50">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-semibold w-100" onclick="return confirm('Yakin ingin menghapus lowongan ini?')">
                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light text-center border py-4 text-muted">
                        <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                        Belum ada data lowongan kerja.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection