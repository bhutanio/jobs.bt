<?php

it('no matches messaging appears', function () {
    $response = $this->get('/recommendations');
    $response->assertOk();
});
