<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiPencapaian extends Model
{
    protected $table = 'prestasi_pencapaian';
    protected $primaryKey = 'prestasi_id';

    protected $fillable = [
        'nama_prestasi',
        'penyelenggara_tingkat',
        'tahun_diraih',
        'deskripsi_prestasi',
        'bukti_dokumentasi',
        'anggota_alumni_id',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function anggotaAlumni()
    {
        return $this->belongsTo(AnggotaAlumni::class, 'anggota_alumni_id');
    }
}