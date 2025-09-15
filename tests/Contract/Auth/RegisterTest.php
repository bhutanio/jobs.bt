<?php

use Illuminate\Testing\Fluent\AssertableJson;

it('POST /auth/register returns 201 with required fields', function () {
    $payload = [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'phone' => '+11234567890',
        'password' => 'secret1234',
        'role' => 'job_seeker',
    ];

    $response = $this->postJson('/api/auth/register', $payload);

    $response->assertCreated();
});
