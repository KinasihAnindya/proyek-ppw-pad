@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-4">Tambah Lowongan Kerja Baru</h4>

                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Judul Lowongan</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Nama Perusahaan</label>
                                <input type="text" name="company" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jenis Pekerjaan</label>
                                <select name="type" class="form-select" required>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Freelance">Freelance</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Lokasi</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Gaji (Nominal Rp)</label>
                                <input type="number" name="salary" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Deskripsi Pekerjaan</label>
                            <textarea name="description" rows="4" class="form-control" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Logo Perusahaan</label>
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <a href="{{ route('jobs.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection