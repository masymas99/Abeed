<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JobCategoryListing extends Pivot
{
    use HasFactory;

    protected $table = 'job_category_listing';

    // If you have additional columns, add them to fillable
    protected $fillable = [
        'job_listing_id',
        'job_category_id',
    ];
}
