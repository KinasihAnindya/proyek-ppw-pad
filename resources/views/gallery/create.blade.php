@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 col-md-8 mx-auto">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">Unggah Foto Galeri Lowongan</h4>
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Lowongan Kerja</label>
                    <select name="job_vacancy_id" class="form-select" required>
                        <option value="">-- Pilih Lowongan --</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->id }}">{{ $job->title }} ({{ $job->company }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Foto</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">File Gambar</label>
                    <input type="file" name="picture" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Foto</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection