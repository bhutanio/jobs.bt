<?php

it('GET /recommendations returns 200', function () {
    $response = $this->getJson('/api/recommendations');
    $response->assertOk();
});
