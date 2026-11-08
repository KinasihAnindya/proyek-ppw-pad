<?php

namespace App\Http\Controllers;

use App\Models\BeritaIsu;
use Illuminate\Http\Request;

class BeritaIsuController extends Controller
{
    public function index(Request $request) {
    $batas = 5;
    $query = BeritaIsu::with('admin');

    if ($request->filled('search')) {
        $query->where('judul_berita', 'like', '%'.$request->search.'%');
    }

    if ($request->filled('kategori') && $request->kategori != 'Semua Kategori') {
        $query->where('kategori_isu', $request->kategori);
    }

    $data_berita = $query->orderBy('tanggal_publikasi', 'desc')->paginate($batas);
    
    $data_berita->appends($request->all());

    $no = $batas * ($data_berita->currentPage() - 1);

    return view('berita.index', compact('data_berita', 'no'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_berita'      => 'required|string|max:255',
            'kategori_isu'      => 'required',
            'ringkasan_isi'     => 'required',
            'konten_lengkap'    => 'required',
            'tanggal_publikasi' => 'required|date'
        ], [
            'judul_berita.required'      => 'Judul berita wajib diisi.',
            'kategori_isu.required'      => 'Kategori isu wajib dipilih.',
            'ringkasan_isi.required'     => 'Ringkasan isi tidak boleh kosong.',
            'konten_lengkap.required'    => 'Konten lengkap wajib diisi.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib diisi.'
        ]);

        BeritaIsu::create([
            'judul_berita'      => $request->judul_berita,
            'kategori_isu'      => $request->kategori_isu,
            'ringkasan_isi'     => $request->ringkasan_isi,
            'konten_lengkap'    => $request->konten_lengkap,
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'admin_id'          => auth()->id() ?? 1, 
        ]);

        return redirect('/berita')->with('pesan', 'Data Berita Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $berita = BeritaIsu::findOrFail($id);

        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = BeritaIsu::findOrFail($id);

        $this->validate($request, [
            'judul_berita'      => 'required|string|max:255',
            'kategori_isu'      => 'required',
            'ringkasan_isi'     => 'required',
            'konten_lengkap'    => 'required',
            'tanggal_publikasi' => 'required|date'
        ], [
            'judul_berita.required'      => 'Judul berita wajib diisi.',
            'kategori_isu.required'      => 'Kategori isu wajib dipilih.',
            'ringkasan_isi.required'     => 'Ringkasan isi tidak boleh kosong.',
            'konten_lengkap.required'    => 'Konten lengkap wajib diisi.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib diisi.'
        ]);

        $berita->update([
            'judul_berita'      => $request->judul_berita,
            'kategori_isu'      => $request->kategori_isu,
            'ringkasan_isi'     => $request->ringkasan_isi,
            'konten_lengkap'    => $request->konten_lengkap,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ]);

        return redirect('/berita')->with('pesan', 'Data Berita Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $berita = BeritaIsu::findOrFail($id);
        $berita->delete();

        return redirect('/berita')->with('pesan', 'Data Berita Berhasil Dihapus!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}