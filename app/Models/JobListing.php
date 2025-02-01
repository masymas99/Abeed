<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $table = 'job_listings';

    protected $fillable = [
        'job_title',
        'description',
        'location',
        'work_type',
        'salary_min',
        'salary_max'
    ];

    public function getTitleAttribute()
    {
        return $this->job_title;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Application.
     * A job listing can have many applications.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Relationship with JobCategory.
     * A job listing can belong to many categories.
     */
    public function categories()
    {
        return $this->belongsToMany(JobCategory::class, 'job_category_listing');
    }
}
