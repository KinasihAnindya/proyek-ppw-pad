<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaIsu extends Model
{
    protected $table = 'berita_isu';

    protected $primaryKey = 'berita_id';

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    protected $fillable = [
        'judul_berita', 
        'ringkasan_isi', 
        'konten_lengkap', 
        'kategori_isu', 
        'gambar_header', 
        'tanggal_publikasi', 
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}