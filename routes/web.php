<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->view('welcome'));
Route::get('/resume/builder', fn () => response('Resume Builder', 200));
Route::get('/jobs/generator', fn () => response('Job Generator', 200));
Route::get('/dashboard/employer', fn () => response('Employer Dashboard', 200));
Route::get('/recommendations', fn () => response('Recommendations', 200));

// Fallback AI unavailable behavior would be handled in controller later
Route::post('/ai/resume', fn () => response('AI unavailable', 503));
Route::post('/jobs/{id}/apply', fn (string $id) => redirect('/jobs/'.$id));
