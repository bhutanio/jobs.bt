@extends('layouts.app')

@section('title', 'Recent Jobs')

@push('styles')
<style>
    .job-card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; }
    .job-title { font-size: 1.125rem; font-weight: 600; margin: 0 0 .25rem; }
    .job-meta { color: #6b7280; font-size: .9rem; }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h1>Recent Jobs</h1>
    @forelse ($jobs as $job)
        <div class="job-card">
            <div class="job-title">
                <a href="/jobs/{{ $job->id }}">{{ $job->title }}</a>
            </div>
            <div class="job-meta">
                <span>{{ optional($job->company)->name ?? 'Company' }}</span>
                <x-company-badge :company="$job->company" />
                <span>·</span>
                <span>{{ $job->location ?? 'Location' }}</span>
                @if ($job->salary)
                    <span>·</span>
                    <span>{{ $job->salary }}</span>
                @endif
                @if ($job->published_at)
                    <span>·</span>
                    <span>{{ $job->published_at->diffForHumans() }}</span>
                @endif
            </div>
            @if (!empty($job->description))
                <p style="margin-top: .5rem; color: #374151;">
                    {{ $job->excerpt }}
                </p>
            @endif
        </div>
    @empty
        <p>No recent jobs.</p>
    @endforelse

    @if (method_exists($jobs, 'links'))
        <div style="margin-top: 1rem;">
            {{ $jobs->links() }}
        </div>
    @endif
</div>
@endsection


