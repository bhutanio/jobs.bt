<?php

use App\Services\AI\Providers\ProviderClient;

it('generates a resume draft structure', function () {
    $service = new ProviderClient();
    $draft = $service->generateResumeDraft(['skills' => ['PHP', 'Laravel']]);

    expect($draft)->toBeArray()
        ->and($draft)->toHaveKeys(['draft', 'input']);
});
