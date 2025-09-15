<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosting>
 */
class JobPostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'requirements' => 'PHP, Laravel',
            'location' => fake()->city(),
            'employment_type' => fake()->randomElement(['full_time','part_time','contract','intern','temp']),
            'salary' => null,
            'status' => 'draft',
            'published_at' => null,
        ];
    }
}
