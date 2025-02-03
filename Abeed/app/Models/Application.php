<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'full_name',
        'contact_email',
        'resume',
        'job_listing_id',
        'status',
        'contact_phone',
    ];

    /**
     * Relationship with User.
     * An application belongs to a candidate.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with JobListing.
     * An application belongs to a job listing.
     */
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
