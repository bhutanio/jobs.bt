<?php

it('POST /ai/job returns 200', function () {
    $payload = [
        'title' => 'Senior PHP Engineer',
        'seniority' => 'senior',
        'requirements' => ['php', 'laravel'],
    ];

    $response = $this->postJson('/api/ai/job', $payload);
    $response->assertOk();
});
