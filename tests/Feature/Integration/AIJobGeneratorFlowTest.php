<?php

it('employer can access AI job generator page', function () {
    $response = $this->get('/jobs/generator');
    $response->assertOk();
});
