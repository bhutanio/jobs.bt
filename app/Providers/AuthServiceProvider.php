<?php

namespace App\Providers;

use App\Models\Resume;
use App\Models\User;
use App\Policies\ResumePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Resume::class => ResumePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', fn (User $user) => $user->hasRole('admin'));
        Gate::define('is-employer', fn (User $user) => $user->hasRole('employer'));
        Gate::define('is-job-seeker', fn (User $user) => $user->hasRole('job_seeker'));
    }
}
