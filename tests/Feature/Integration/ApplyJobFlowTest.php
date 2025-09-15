<?php

it('apply to job flow shows confirmation', function () {
    $response = $this->post('/jobs/1/apply', [
        'resume_id' => 1,
    ]);

    $response->assertRedirect();
});
