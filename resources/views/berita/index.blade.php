@extends('layouts.master')

@section('content')

    <h2>Daftar Berita & Isu</h2>
    <p><a href="{{ url('/berita/create') }}">Tambah Berita</a></p>
    <form action="{{ url('/berita') }}" method="GET" style="margin-bottom: 15px;">
    <input type="text" name="search" placeholder="Cari judul berita..." value="{{ request('search') }}">
    
    <select name="kategori">
        <option value="Semua Kategori">Semua Kategori</option>
        <option value="Isu Strategis" {{ request('kategori') == 'Isu Strategis' ? 'selected' : '' }}>Isu Strategis</option>
        <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event</option>
        <option value="Riset" {{ request('kategori') == 'Riset' ? 'selected' : '' }}>Riset</option>
    </select>

    <button type="submit">Cari</button>

    @if(Session::has('pesan'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px;">
            {{ Session::get('pesan') }}
        </div>
    @endif

    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Berita</th>
            <th>Isi / Ringkasan</th>
            <th>Tanggal Publikasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data_berita as $index => $berita)
            <tr>
                <td>{{ $no + $index + 1 }}</td>
                <td><strong>{{ $berita->judul_berita }}</strong></td>
                <td>{{ $berita->ringkasan_isi }}</td>
                <td>{{ $berita->tanggal_publikasi->format('d/m/Y') }}</td>

                <td>
                    <a href="{{ route('berita.edit', $berita->berita_id) }}">Edit</a>
                    <form action="{{ route('berita.destroy', $berita->berita_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data berita.</td>
            </tr>
        @endforelse
    </tbody>
</table>
    <div style="margin-top: 15px;">
        <div style="margin-top: 15px;">
    {{ $data_berita->links('pagination::simple-bootstrap-4') }}
</div>
    </div>

@endsection