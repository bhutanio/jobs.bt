<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\Resume;
use App\Models\User;

class ResumePolicy
{
    /**
     * Employers may view resumes only when attached to their job applications.
     * Job seekers may view their own resumes.
     */
    public function view(User $user, Resume $resume): bool
    {
        if ($user->hasRole('job_seeker')) {
            return $resume->user_id === $user->id;
        }

        if ($user->hasRole('employer')) {
            // Employers may view resumes only if they were attached to any application
            $has_attached_application = Application::query()
                ->where('resume_id', $resume->id)
                ->exists();

            return $has_attached_application;
        }

        return $user->hasRole('admin');
    }
}
