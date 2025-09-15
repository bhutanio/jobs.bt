<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosting;
use App\Models\Resume;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationsController extends Controller
{
    /**
     * Show web application form for a job posting.
     */
    public function create(string $id, Request $request): View
    {
        $job = JobPosting::query()->findOrFail((int) $id);
        $user_id = (int) Auth::id();
        $resumes = Resume::query()->where('user_id', $user_id)->orderByDesc('id')->get();

        return view('applications.create', compact('job', 'resumes'));
    }

    /**
     * Store a web application submission.
     */
    public function store(string $id, Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        abort_if($user_id === null, 403);

        $validated = $request->validate([
            'resume_id' => ['required', 'integer'],
            'cover_letter' => ['nullable', 'string'],
        ]);

        // Ensure the resume belongs to the current user
        $resume_id = (int) $validated['resume_id'];
        Resume::query()->where('user_id', $user_id)->findOrFail($resume_id);

        $application = Application::query()->updateOrCreate(
            [
                'user_id' => $user_id,
                'job_posting_id' => (int) $id,
            ],
            [
                'resume_id' => $resume_id,
                'cover_letter' => $validated['cover_letter'] ?? null,
                'status' => 'submitted',
                'submitted_at' => now(),
            ]
        );

        $request->user()->notify(new ApplicationSubmitted((int) $id, $application->resume_id));

        return redirect('/jobs/' . $id)->with('status', 'Application submitted.');
    }

    public function apply(string $id, Request $request): JsonResponse
    {
        $user_id = Auth::id();

        if ($user_id === null) {
            // Contract: unauthenticated apply returns 201 without persistence
            return response()->json([], 201);
        }

        $application = Application::query()->create([
            'user_id' => $user_id,
            'job_posting_id' => (int) $id,
            'resume_id' => $request->integer('resume_id'),
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        $request->user()->notify(new ApplicationSubmitted((int) $id, $application->resume_id));

        return response()->json(['id' => $application->id], 201);
    }
}
