<?php

it('AI fallback informs user when AI unavailable', function () {
    $response = $this->post('/ai/resume', []);
    $response->assertStatus(503);
});
