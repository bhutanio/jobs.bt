<?php

it('registers job seeker and lands on job seeker dashboard', function () {
    $response = $this->post('/register', [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'phone' => '+11234567890',
        'password' => 'secret1234',
        'password_confirmation' => 'secret1234',
        'role' => 'job_seeker',
    ]);

    $response->assertRedirect();
});
