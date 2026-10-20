<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaAlumni extends Model
{
    protected $table = 'anggota_alumni';
    protected $primaryKey = 'anggota_alumni_id';

    protected $fillable = [
        'nama_lengkap',
        'kepakaran',
        'peran_lab',
        'tahun_masuk',
        'tahun_lulus_keluar',
        'kontak_profesional',
        'tautan_repositori_pribadi',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function proyekRiset()
    {
        return $this->belongsToMany(ProyekRiset::class, 'jnc_proyek_anggota', 'anggota_alumni_id', 'proyek_id')
                    ->withPivot('peran_spesifik')
                    ->withTimestamps();
    }
}