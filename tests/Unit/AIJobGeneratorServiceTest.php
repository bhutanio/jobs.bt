<?php

use App\Services\AI\Providers\ProviderClient;

it('generates a job draft structure', function () {
    $service = new ProviderClient();
    $draft = $service->generateJobDraft(['title' => 'Backend Engineer']);

    expect($draft)->toBeArray()
        ->and($draft)->toHaveKeys(['draft', 'input']);
});
