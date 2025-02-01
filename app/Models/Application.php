<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'job_id',
        'user_id',
        'full_name',
        'contact_email',
        'resume',
        'job_listing_id',
        'status'
    ];

   /*  public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_id', 'id');
    } */

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
        return $this->belongsTo(JobListing::class);    }
}
