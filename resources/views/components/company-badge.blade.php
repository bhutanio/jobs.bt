@props(['company'])

@php
    $is_verified = optional($company)->verified_at !== null;
@endphp

@if ($is_verified)
    <span class="badge bg-success" title="Verified company">Verified</span>
@endif


