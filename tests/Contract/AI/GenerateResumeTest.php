<?php

it('POST /ai/resume returns 200', function () {
    $payload = [
        'work_history' => [],
        'education' => [],
        'skills' => ['php', 'laravel'],
    ];

    $response = $this->postJson('/api/ai/resume', $payload);
    $response->assertOk();
});
