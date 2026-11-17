@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Kelola Galeri Lowongan</h3>
        <a href="{{ route('gallery.create') }}" class="btn btn-primary">+ Tambah Foto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($galleries as $gallery)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <a href="{{ asset('storage/' . $gallery->picture) }}" 
                       data-lightbox="admin-gallery" 
                       data-title="{{ $gallery->title }} ({{ $gallery->jobVacancy->title ?? 'Lowongan' }})">
                        <img src="{{ asset('storage/' . $gallery->picture) }}" 
                             alt="{{ $gallery->title }}" 
                             class="card-img-top" 
                             style="height: 180px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-info text-dark mb-2 align-self-start">
                            {{ $gallery->jobVacancy->title ?? 'Tanpa Lowongan' }}
                        </span>
                        <h6 class="card-title fw-bold mb-1">{{ $gallery->title }}</h6>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($gallery->description, 60) }}</p>
                        
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm w-50">Edit</a>
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Hapus foto ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Belum ada foto galeri yang diunggah.</h5>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $galleries->links() }}
    </div>
</div>
@endsection