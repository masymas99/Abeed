<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'job_title' => $this->faker->jobTitle,
            'title' => $this->faker->jobTitle, // match your migration column name
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->city,
            'work_type' => $this->faker->randomElement(['Remote', 'On-site']),
            'salary_min' => $this->faker->numberBetween(30000, 50000),
            'salary_max' => $this->faker->numberBetween(60000, 150000),
            'skills_required' => $this->faker->words(4, true),
            'benefits' => $this->faker->paragraph,
            'application_deadline' => $this->faker->dateTimeBetween('now', '+30 days'),
        ];
    }
}
