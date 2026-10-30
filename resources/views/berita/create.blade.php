@extends('layouts.master')

@section('content')

    <h2>Tambah Berita Baru</h2>
    <p><a href="{{ url('/berita') }}">Kembali ke Daftar Berita</a></p>

    {{-- Pesan Error Validasi Bahasa Indonesia --}}
    @if (count($errors) > 0)
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/berita') }}" method="POST">
        @csrf
        <p>
            <label>Judul Berita:</label><br>
            <input type="text" name="judul_berita" value="{{ old('judul_berita') }}" style="width: 100%;">
        </p>

        <p>
            <label>Kategori Isu:</label><br>
            <select name="kategori_isu">
                <option value="Isu Strategis" {{ old('kategori_isu') == 'Isu Strategis' ? 'selected' : '' }}>Isu Strategis</option>
                <option value="Event" {{ old('kategori_isu') == 'Event' ? 'selected' : '' }}>Event</option>
                <option value="Riset" {{ old('kategori_isu') == 'Riset' ? 'selected' : '' }}>Riset</option>
            </select>
        </p>

        <p>
            <label>Ringkasan Isi:</label><br>
            <textarea name="ringkasan_isi" style="width: 100%; height: 60px;">{{ old('ringkasan_isi') }}</textarea>
        </p>

        <p>
            <label>Konten Lengkap:</label><br>
            <textarea name="konten_lengkap" style="width: 100%; height: 100px;">{{ old('konten_lengkap') }}</textarea>
        </p>

        <div class="mb-3">
        <label for="tanggal_publikasi" class="form-label fw-semibold">Tanggal Publikasi</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
      
            <input type="date" 
               class="form-control @error('tanggal_publikasi') is-invalid @enderror" 
               id="tanggal_publikasi" 
               name="tanggal_publikasi" 
               value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" 
               required>
        </div>
        @error('tanggal_publikasi')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
        <button type="submit">Simpan Berita</button>
    </form>

@endsection