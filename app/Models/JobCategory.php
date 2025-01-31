<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relationship with JobListing.
     * A category can have many job listings.
     */
    public function jobListings()
    {
        return $this->belongsToMany(JobListing::class, 'job_category_listing');
    }
}
