<?php

it('employer dashboard lists applicants', function () {
    $response = $this->get('/dashboard/employer');
    $response->assertOk();
});
