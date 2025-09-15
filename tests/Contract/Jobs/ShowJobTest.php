<?php

it('GET /jobs/{id} returns 200', function () {
    $response = $this->getJson('/api/jobs/1');
    $response->assertOk();
});
