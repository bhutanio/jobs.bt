@extends('layouts.app')

@section('title', $job->title ?? 'Job')

@section('content')
<div class="container my-5">
    <h1>{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ optional($job->company)->name ?? 'Company' }} <x-company-badge :company="$job->company" /></p>
    <p><strong>Location:</strong> {{ $job->location ?? 'Location' }}</p>
    @if ($job->salary)
        <p><strong>Salary:</strong> {{ $job->salary }}</p>
    @endif
    <article>
        {!! nl2br(e($job->description)) !!}
    </article>
    <form method="post" action="/jobs/{{ $job->id }}/apply" style="margin-top: 1rem;">
        <input type="hidden" name="resume_id" value="1" />
        <button type="submit">Apply</button>
    </form>
</div>
@endsection


