<?php

namespace App\Http\Controllers;

use App\Services\RecommendationsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RecommendationsController extends Controller
{
    public function index(RecommendationsService $service): JsonResponse
    {
        return response()->json($service->listForUser(Auth::id()));
    }
}
