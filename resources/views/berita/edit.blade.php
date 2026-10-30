@extends('layouts.master')

@section('content')

    <h2>Edit Berita & Isu</h2>
    <p><a href="{{ route('berita.index') }}">« Kembali ke Daftar Berita</a></p>

    {{-- Menampilkan Pesan Validasi Error --}}
    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Data Berita menggunakan route resource --}}
    <form action="{{ route('berita.update', $berita->berita_id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Tambahkan directive ini untuk mensimulasikan request PUT --}}

        <p>
            <label>Judul Berita:</label><br>
            <input type="text" name="judul_berita" value="{{ old('judul_berita', $berita->judul_berita) }}" style="width: 100%; max-width: 500px;">
        </p>

        <p>
            <label>Kategori Isu:</label><br>
            <select name="kategori_isu">
                <option value="">-- Pilih Kategori --</option>
                <option value="Isu Strategis" {{ old('kategori_isu', $berita->kategori_isu) == 'Isu Strategis' ? 'selected' : '' }}>Isu Strategis</option>
                <option value="Event" {{ old('kategori_isu', $berita->kategori_isu) == 'Event' ? 'selected' : '' }}>Event</option>
                <option value="Riset" {{ old('kategori_isu', $berita->kategori_isu) == 'Riset' ? 'selected' : '' }}>Riset</option>
            </select>
        </p>

        <div class="mb-3">
    <label for="tanggal_publikasi" class="form-label fw-semibold">Tanggal Publikasi</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
        <input type="date" 
               class="form-control @error('tanggal_publikasi') is-invalid @enderror" 
               id="tanggal_publikasi" 
               name="tanggal_publikasi" 
               value="{{ old('tanggal_publikasi', \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('Y-m-d')) }}" 
               required>
    </div>
    @error('tanggal_publikasi')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

        <p>
            <label>Ringkasan Isi:</label><br>
            <textarea name="ringkasan_isi" rows="3" style="width: 100%; max-width: 500px;">{{ old('ringkasan_isi', $berita->ringkasan_isi) }}</textarea>
        </p>

        <p>
            <label>Konten Lengkap:</label><br>
            <textarea name="konten_lengkap" rows="6" style="width: 100%; max-width: 500px;">{{ old('konten_lengkap', $berita->konten_lengkap) }}</textarea>
        </p>

        <p>
            <button type="submit">Simpan Perubahan</button>
        </p>
    </form>

@endsection