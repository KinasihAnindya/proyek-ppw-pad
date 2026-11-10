@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-4">Edit Data Lowongan Kerja</h4>

                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Judul Lowongan</label>
                            <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Nama Perusahaan</label>
                                <input type="text" name="company" class="form-control" value="{{ $job->company }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jenis Pekerjaan</label>
                                <select name="type" class="form-select" required>
                                    <option value="Full-time" {{ $job->type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="Part-time" {{ $job->type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="Contract" {{ $job->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="Freelance" {{ $job->type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Lokasi</label>
                                <input type="text" name="location" class="form-control" value="{{ $job->location }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Gaji (Nominal Rp)</label>
                                <input type="number" name="salary" class="form-control" value="{{ $job->salary }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Deskripsi Pekerjaan</label>
                            <textarea name="description" rows="4" class="form-control" required>{{ $job->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Logo Perusahaan</label>
                            @if($job->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $job->logo) }}" width="80" class="rounded border">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('jobs.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection