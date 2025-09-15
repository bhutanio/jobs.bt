<?php

use App\Models\JobPosting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $jobs = collect();
    if (Schema::hasTable('job_postings')) {
        $jobs = Cache::remember('recent_jobs_web', 60, function () {
            return JobPosting::query()
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->limit(20)
                ->get();
        });
    }

    return response()->view('home', compact('jobs'));
});
Route::get('/resume/builder', fn () => response()->view('resume.builder'));
Route::get('/jobs/generator', fn () => response()->view('jobs.generator'));
Route::get('/dashboard/employer', fn () => response()->view('dashboards.employer'));
Route::get('/dashboard/job-seeker', fn () => response()->view('dashboards.job_seeker'));
Route::get('/recommendations', fn () => response('Recommendations', 200));

// Fallback AI unavailable behavior would be handled in controller later
Route::post('/ai/resume', fn () => response('AI unavailable', 503));
Route::get('/jobs/{id}', function (string $id) {
    $job = JobPosting::query()->findOrFail($id);
    return response()->view('jobs.show', compact('job'));
});

Route::post('/jobs/{id}/apply', fn (string $id) => redirect('/jobs/' . $id));
