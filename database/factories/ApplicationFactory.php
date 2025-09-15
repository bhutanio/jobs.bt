<?php

namespace Database\Factories;

use App\Models\JobPosting;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $resume = Resume::factory()->create(['user_id' => $user->id]);

        return [
            'user_id' => $user->id,
            'job_posting_id' => JobPosting::factory(),
            'resume_id' => $resume->id,
            'cover_letter' => fake()->optional()->paragraph(),
            'status' => 'submitted',
            'submitted_at' => now(),
        ];
    }
}
