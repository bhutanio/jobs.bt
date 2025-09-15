@extends('layouts.app')

@section('title', 'AI Job Generator')

@push('styles')
<style>
    .card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h1>AI Job Generator</h1>
    <div class="card">
        <p>Provide a job title and requirements to generate a draft.</p>
        <form method="post" action="/api/ai/job">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label>Job title</label>
                <input type="text" name="title" />
            </div>
            <div>
                <label>Requirements</label>
                <input type="text" name="requirements" />
            </div>
            <button type="submit">Generate Draft</button>
        </form>
    </div>
</div>
@endsection


