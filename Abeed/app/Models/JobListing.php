<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'work_type',
        'salary_min',
        'salary_max',
        'user_id',
        'application_deadline',
        'skills_required',
        'benefits',

    ];

    /**
     * Relationship with User.
     * A job listing belongs to an employer.
     */
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
