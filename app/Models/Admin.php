<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'email',
        'password',
        'nama_lengkap',
        'peran',
        'status_akses'
    ];

    protected $hidden = [
        'password',
    ];

    public function beritaIsu()
    {
        return $this->hasMany(BeritaIsu::class, 'admin_id');
    }

    public function proyekRiset()
    {
        return $this->hasMany(ProyekRiset::class, 'admin_id');
    }
}