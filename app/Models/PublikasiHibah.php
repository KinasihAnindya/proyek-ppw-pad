<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiHibah extends Model
{
    protected $table = 'publikasi_hibah';
    protected $primaryKey = 'publikasi_id';

    protected $fillable = [
        'judul_publikasi_hibah',
        'jenis_luaran',
        'nama_jurnal_pemberi_hibah',
        'tahun_terbit_pendanaan',
        'tautan_doi_dokumen',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}