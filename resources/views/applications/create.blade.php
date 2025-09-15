@extends('layouts.app')

@section('title', 'Apply: ' . ($job->title ?? 'Job'))

@section('content')
<div class="container my-5">
    <h1>Apply for {{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ optional($job->company)->name ?? 'Company' }}</p>

    <form method="post" action="/jobs/{{ $job->id }}/apply" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="resume_id" class="form-label">Resume</label>
            <select class="form-select @error('resume_id') is-invalid @enderror" id="resume_id" name="resume_id" required>
                @foreach ($resumes as $resume)
                    <option value="{{ $resume->id }}" @selected(old('resume_id') == $resume->id)>
                        Resume #{{ $resume->id }} {{ $resume->version_label ? '(' . $resume->version_label . ')' : '' }}
                    </option>
                @endforeach
            </select>
            @error('resume_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_letter" class="form-label">Cover Letter (optional)</label>
            <textarea class="form-control @error('cover_letter') is-invalid @enderror" id="cover_letter" name="cover_letter" rows="8" placeholder="Write a brief cover letter...">{{ old('cover_letter') }}</textarea>
            @error('cover_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit application</button>
        <a href="/jobs/{{ $job->id }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
