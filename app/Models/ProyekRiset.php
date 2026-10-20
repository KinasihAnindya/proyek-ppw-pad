<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekRiset extends Model
{
    protected $table = 'proyek_riset';
    protected $primaryKey = 'proyek_id';

    protected $fillable = [
        'judul_penelitian_simulasi',
        'deskripsi_singkat',
        'tanggal_mulai',
        'status_proyek',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function anggotaAlumni()
    {
        return $this->belongsToMany(AnggotaAlumni::class, 'jnc_proyek_anggota', 'proyek_id', 'anggota_alumni_id')
                    ->withPivot('peran_spesifik')
                    ->withTimestamps();
    }
}