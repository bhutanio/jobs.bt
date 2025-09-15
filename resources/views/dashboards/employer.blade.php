@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container my-5">
    <h1>Employer Dashboard</h1>
    <p>Manage your job postings and applicants.</p>
    <ul>
        <li><a href="/jobs/generator">Generate Job Posting</a></li>
        <li><a href="/">View Recent Jobs</a></li>
    </ul>
 </div>
@endsection


