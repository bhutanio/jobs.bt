<?php

it('recommendations page shows suggestions', function () {
    $response = $this->get('/recommendations');
    $response->assertOk();
});
