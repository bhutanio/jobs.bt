<?php

it('POST /jobs returns 201 for employer', function () {
    $payload = [
        'title' => 'Backend Engineer',
        'description' => 'Job description',
        'requirements' => 'PHP, Laravel',
        'location' => 'Remote',
    ];

    $response = $this->postJson('/api/jobs', $payload);
    $response->assertCreated();
});
