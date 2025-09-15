<?php

it('registers employer and lands on employer dashboard', function () {
    $response = $this->post('/register', [
        'name' => 'Acme HR',
        'email' => 'hr@example.com',
        'phone' => '+11234567890',
        'password' => 'secret1234',
        'password_confirmation' => 'secret1234',
        'role' => 'employer',
        'company_name' => 'Acme, Inc.',
    ]);

    $response->assertRedirect();
});
