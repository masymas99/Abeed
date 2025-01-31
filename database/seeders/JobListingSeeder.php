<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    public function run()
    {
        JobListing::factory()->count(10)->create();

        JobListing::factory()->create([
            'job_title' => 'Senior Laravel Developer',
            'description' => 'We are looking for an experienced Laravel developer to join our team...',
            'location' => 'New York',
            'work_type' => 'Full-time',
            'salary_min' => 80000,
            'salary_max' => 120000,
        ]);
    }
}
