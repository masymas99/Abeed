<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $table = 'empjobs';

    protected $fillable = [
        'job_title',
        'description',
        'location',
        'work_type',
        'salary_min',
        'salary_max'
    ];

    // Add accessor for backward compatibility
    public function getTitleAttribute()
    {
        return $this->job_title;
    }
}
