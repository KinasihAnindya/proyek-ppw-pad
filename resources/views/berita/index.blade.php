@extends('layouts.master')

@section('title', 'Daftar Berita & Isu')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="m-0 fw-bold text-primary">
            <i class="fa-solid fa-newspaper me-2"></i>Daftar Berita & Isu
        </h4>
        <a href="{{ route('berita.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i>Tambah Berita
        </a>
    </div>

    <div class="card-body">
        @if(Session::has('pesan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ Session::get('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('berita.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul berita..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="Isu Strategis" {{ request('kategori') == 'Isu Strategis' ? 'selected' : '' }}>Isu Strategis</option>
                    <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Riset" {{ request('kategori') == 'Riset' ? 'selected' : '' }}>Riset</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    Filter Data
                </button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Judul Berita</th>
                        <th width="15%">Kategori</th>
                        <th>Isi / Ringkasan</th>
                        <th width="15%">Tanggal Publikasi</th>
                        <th width="18%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_berita as $item)
                    <tr>
                        <td class="fw-bold">{{ ++$no }}</td>
                        <td class="fw-semibold text-primary">{{ $item->judul_berita }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $item->kategori_isu ?? 'Umum' }}
                            </span>
                        </td>
                        <td class="text-muted">{{ Str::limit($item->ringkasan_isi ?? $item->konten_lengkap ?? $item->isi_berita, 60) }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->tanggal_publikasi }}</span></td>
                        <td class="text-center">
                            <form action="{{ route('berita.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <a href="{{ route('berita.edit', $item) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data berita ini?')">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Data berita tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="text-muted small">Menampilkan {{ $data_berita->count() }} data dari total {{ $data_berita->total() }} berita</span>
            <div>
                {{ $data_berita->links() }}
            </div>
        </div>

    </div>
</div>
@endsection