<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'description' => $this->faker->paragraphs(3, true),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
