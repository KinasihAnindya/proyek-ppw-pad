@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 col-md-8 mx-auto">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">Edit Foto Galeri Lowongan</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Pilih Lowongan Kerja</label>
                    <select name="job_vacancy_id" class="form-select" required>
                        <option value="">-- Pilih Lowongan --</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->id }}" {{ $gallery->job_vacancy_id == $job->id ? 'selected' : '' }}>
                                {{ $job->title }} ({{ $job->company }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Foto</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Gambar</label>
                    @if($gallery->picture)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $gallery->picture) }}" alt="{{ $gallery->title }}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="picture" class="form-control" accept="image/jpeg, image/png, image/jpg">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar (Format JPG/PNG, maks. 2MB).</small>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Foto</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection