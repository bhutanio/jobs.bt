<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $jobs = Cache::remember('recent_jobs_api', 60, function () {
            return JobPosting::query()
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->limit(20)
                ->get(['id', 'title', 'location', 'salary', 'published_at']);
        });

        return response()->json(['data' => $jobs]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json([], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(['id' => (int) $id]);
    }
}
