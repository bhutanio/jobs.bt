<?php

it('GET /jobs returns 200', function () {
    $response = $this->getJson('/api/jobs');
    $response->assertOk();
});
