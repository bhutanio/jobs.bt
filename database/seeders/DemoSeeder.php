<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosting;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo employer and company
        $employer = User::query()->firstOrCreate([
            'email' => 'employer@example.com',
        ], [
            'name' => 'Demo Employer',
            'password' => Hash::make('password'),
        ]);

        if (! $employer->hasRole('employer')) {
            $employer->assignRole('employer');
        }

        $company = Company::query()->firstOrCreate([
            'name' => 'Acme Inc.',
        ], [
            'description' => 'We build things.',
            'verified_at' => now(),
        ]);

        // Create some job postings
        JobPosting::factory()->count(5)->create([
            'company_id' => $company->id,
            'status' => 'published',
            'published_at' => now()->subDays(1),
        ]);

        // Create a demo job seeker with a resume
        $seeker = User::query()->firstOrCreate([
            'email' => 'seeker@example.com',
        ], [
            'name' => 'Demo Seeker',
            'password' => Hash::make('password'),
        ]);

        if (! $seeker->hasRole('job_seeker')) {
            $seeker->assignRole('job_seeker');
        }

        Resume::query()->firstOrCreate([
            'user_id' => $seeker->id,
            'version_label' => 'v1',
        ], [
            'content' => "Demo resume for Demo Seeker\nSkills: PHP, Laravel",
        ]);
    }
}
