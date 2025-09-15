@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
<div class="container my-5">
    <h1>Job Seeker Dashboard</h1>
    <p>Welcome! View recommendations, saved jobs, and applications here.</p>
    <ul>
        <li><a href="/recommendations">Recommendations</a></li>
        <li><a href="/">Recent Jobs</a></li>
    </ul>
 </div>
@endsection


