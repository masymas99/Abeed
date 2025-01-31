<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run()
    {
        JobListing::factory()->count(10)->create();

        JobListing::factory()->create([
            'title' => 'Senior Laravel Developer',
            'company' => 'Tech Solutions Inc',
            'description' => 'We are looking for an experienced Laravel developer to join our team...',
            'salary' => 85000.00,
        ]);

        JobListing::factory()->create([
            'title' => 'Frontend React Developer',
            'company' => 'Digital Innovations',
            'description' => 'Seeking a skilled frontend developer with React expertise...',
            'salary' => 75000.00,
        ]);
    }
}
