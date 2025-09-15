<?php

it('home page lists recent jobs', function () {
    $response = $this->get('/');
    $response->assertOk();
});
