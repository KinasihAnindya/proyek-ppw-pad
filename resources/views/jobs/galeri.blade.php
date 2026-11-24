@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Galeri: {{ $job->title }}</h3>
            <p class="text-muted mb-0">{{ $job->company }} • {{ $job->location }}</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Lowongan</a>
    </div>

    <div class="row">
        @forelse($galleries as $data)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <a href="{{ asset('storage/' . $data->picture) }}" 
                        data-lightbox="job-gallery-{{ $job->id }}" 
                        data-title="{{ $data->title }} - {{ $data->description }}">
                    <img src="{{ asset('storage/' . $data->picture) }}" 
                        alt="{{ $data->title }}" 
                        class="card-img-top" 
                        style="height: 220px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-1">{{ $data->title }}</h6>
                        <p class="card-text text-muted small mb-0">{{ $data->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Belum ada foto galeri untuk lowongan ini.</h5>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $galleries->links() }}
    </div>
</div>
@endsection