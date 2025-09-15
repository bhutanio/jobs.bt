<?php

use App\Models\JobPosting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ApplicationsController;

Route::get('/', function () {
    $jobs = collect();
    if (Schema::hasTable('job_postings')) {
        $jobs = JobPosting::query()
            ->with('company')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(10)
            ->withQueryString();
    }

    return response()->view('home', compact('jobs'));
});
Route::get('/resume/builder', fn () => response()->view('resume.builder'));
Route::get('/jobs/generator', fn () => response()->view('jobs.generator'));
Route::get('/recommendations', fn () => response('Recommendations', 200));

// Fallback AI unavailable behavior would be handled in controller later
Route::post('/ai/resume', fn () => response('AI unavailable', 503));
Route::get('/jobs/{id}', function (string $id) {
    $job = JobPosting::query()->findOrFail($id);
    return response()->view('jobs.show', compact('job'));
});

// Application form (web)
Route::middleware('auth')->group(function () {
    Route::get('/jobs/{id}/apply', [ApplicationsController::class, 'create']);
    Route::post('/jobs/{id}/apply', [ApplicationsController::class, 'store']);
});

// Authenticated dashboards with role-based access
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = request()->user();

        // Sync Spatie roles for legacy users based on the users.role column
        if (! empty($user->role) && ! $user->hasRole($user->role)) {
            $user->syncRoles([$user->role]);
        }

        if ($user->hasRole('employer')) {
            return redirect()->route('dashboard.employer');
        }

        if ($user->hasRole('job_seeker')) {
            return redirect()->route('dashboard.job_seeker');
        }

        return redirect('/');
    })->name('dashboard');

    Route::get('/dashboard/employer', fn () => response()->view('dashboards.employer'))
        ->name('dashboard.employer')
        ->middleware('can:is-employer');

    Route::get('/dashboard/job-seeker', fn () => response()->view('dashboards.job_seeker'))
        ->name('dashboard.job_seeker')
        ->middleware('can:is-job-seeker');
});
