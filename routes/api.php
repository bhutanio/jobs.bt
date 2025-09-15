<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\RecommendationsController;
use App\Http\Controllers\ResumesController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', fn () => response()->json([], 201));

Route::get('/jobs', [JobsController::class, 'index']);
Route::post('/jobs', [JobsController::class, 'store']);
Route::get('/jobs/{id}', [JobsController::class, 'show']);
Route::post('/jobs/{id}/apply', [ApplicationsController::class, 'apply'])->middleware('throttle:apply');

Route::post('/ai/resume', [AIController::class, 'generateResume'])->middleware('throttle:ai');
Route::post('/ai/job', [AIController::class, 'generateJob'])->middleware('throttle:ai');

Route::get('/recommendations', [RecommendationsController::class, 'index']);

// Resume privacy-protected route
Route::get('/resumes/{id}', [ResumesController::class, 'show'])->middleware('auth');
