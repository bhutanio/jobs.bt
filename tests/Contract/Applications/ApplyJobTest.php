<?php

it('POST /jobs/{id}/apply returns 201', function () {
    $payload = [
        'resume_id' => 1,
        'cover_letter' => 'Hello',
    ];

    $response = $this->postJson('/api/jobs/1/apply', $payload);
    $response->assertCreated();
});
