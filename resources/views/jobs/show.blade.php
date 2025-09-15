@extends('layouts.app')

@section('title', $job->title ?? 'Job')

@section('content')
<div class="container my-5">
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <h1>{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ optional($job->company)->name ?? 'Company' }} <x-company-badge :company="$job->company" /></p>
    <p><strong>Location:</strong> {{ $job->location ?? 'Location' }}</p>
    @if ($job->salary)
        <p><strong>Salary:</strong> {{ $job->salary }}</p>
    @endif
    <article>
        {!! nl2br(e($job->description)) !!}
    </article>
    @auth
        <a class="btn btn-primary" href="/jobs/{{ $job->id }}/apply" style="margin-top: 1rem;">Apply</a>
    @else
        <a class="btn btn-outline-primary" href="/login" style="margin-top: 1rem;">Log in to apply</a>
    @endauth
</div>
@endsection


