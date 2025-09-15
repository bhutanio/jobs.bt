<?php

namespace App\Http\Controllers;

use App\Services\AI\AIJobGeneratorService;
use App\Services\AI\AIResumeGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function generateResume(Request $request, AIResumeGeneratorService $service): JsonResponse
    {
        return response()->json($service->generateResumeDraft($request->all()));
    }

    public function generateJob(Request $request, AIJobGeneratorService $service): JsonResponse
    {
        return response()->json($service->generateJobDraft($request->all()));
    }
}
