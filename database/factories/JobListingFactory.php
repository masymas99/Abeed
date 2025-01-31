<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition()
    {
        return [
            'job_title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->city,
            'work_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'salary_min' => $this->faker->numberBetween(30000, 60000),
            'salary_max' => $this->faker->numberBetween(60001, 120000),
        ];
    }
}
