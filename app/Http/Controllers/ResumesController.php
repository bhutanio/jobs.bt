<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ResumesController extends Controller
{
    public function show(string $id): JsonResponse
    {
        $resume = Resume::query()->findOrFail($id);
        Gate::authorize('view', $resume);

        return response()->json([
            'id' => $resume->id,
            'user_id' => $resume->user_id,
            'content' => $resume->content,
            'version_label' => $resume->version_label,
        ]);
    }
}
