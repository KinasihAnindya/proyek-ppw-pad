<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'title',
        'job_seo',
        'description',
        'location',
        'company',
        'type',
        'logo',
        'salary',
    ];

    public function photos()
    {
        return $this->hasMany(JobGallery::class, 'job_vacancy_id', 'id');
    }
}