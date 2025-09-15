<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/register', fn () => response()->json([], 201));

Route::get('/jobs', fn () => response()->json(['data' => []]));
Route::post('/jobs', fn () => response()->json([], 201));
Route::get('/jobs/{id}', fn (string $id) => response()->json(['id' => (int) $id]));
Route::post('/jobs/{id}/apply', fn (string $id) => response()->json([], 201));

Route::post('/ai/resume', fn () => response()->json(['draft' => '...']));
Route::post('/ai/job', fn () => response()->json(['draft' => '...']));

Route::get('/recommendations', fn () => response()->json(['data' => []]));


