<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $table = 'empapplications';

    protected $fillable = [
        'job_id',
        'user_id',
        'full_name',
        'email',
        'resume_path',
        'cover_letter',
        'status'
    ];

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_id', 'id');
    }
}
