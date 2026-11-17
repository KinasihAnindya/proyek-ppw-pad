@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Lowongan Kerja</h3>
        @if(Auth::check() && Auth::user()->level == 'admin')
            <div>
                <a href="{{ route('gallery.index') }}" class="btn btn-info text-white me-2">Kelola Galeri</a>
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">+ Tambah Lowongan</a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            @if($job->logo)
                                <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="rounded me-3" style="width: 55px; height: 55px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center me-3 text-muted fw-bold" style="width: 55px; height: 55px;">
                                    {{ strtoupper(substr($job->company, 0, 2)) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="card-title fw-bold mb-0">{{ $job->title }}</h5>
                                <small class="text-muted">{{ $job->company }} • {{ $job->location }}</small>
                            </div>
                        </div>

                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $job->type }}</span>
                            @if($job->salary)
                                <span class="badge bg-success">Rp {{ number_format($job->salary, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($job->description, 100) }}
                        </p>

                        <div class="mt-3">
                            <a href="{{ route('galeri.lowongan', $job->job_seo ?? Str::slug($job->title)) }}" class="btn btn-outline-info btn-sm w-100 mb-2">
                                Lihat Galeri Perusahaan
                            </a>

                            @if(Auth::check() && Auth::user()->level == 'admin')
                                <div class="d-flex gap-2">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm w-50">Edit</a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin ingin menghapus lowongan ini?')">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Belum ada lowongan kerja yang tersedia.</h5>
            </div>
        @endforelse
    </div>
</div>
@endsection