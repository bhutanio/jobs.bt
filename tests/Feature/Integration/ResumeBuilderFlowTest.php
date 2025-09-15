<?php

it('AI resume builder flow is accessible for authenticated job seeker', function () {
    $response = $this->get('/resume/builder');
    $response->assertOk();
});
