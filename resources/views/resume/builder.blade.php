@extends('layouts.app')

@section('title', 'Resume Builder')

@push('styles')
<style>
    .card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h1>Resume Builder</h1>
    <div class="card">
        <p>Start drafting your resume. AI assistance is available.</p>
        <form method="post" action="/api/ai/resume">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label>Skills</label>
                <input type="text" name="skills" />
            </div>
            <button type="submit">Generate Draft</button>
        </form>
    </div>
</div>
@endsection


