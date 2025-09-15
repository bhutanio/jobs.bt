<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
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
