<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_vacancy_id',
        'title',
        'description',
        'picture',
    ];

    public function JobVacancy() {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id', 'id');
    }
}
