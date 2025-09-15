<?php

use App\Services\RecommendationsService;

it('returns empty recommendations structure', function () {
    $service = new RecommendationsService();
    $result = $service->listForUser(1);
    expect($result)->toBeArray()->and($result)->toHaveKey('data');
});
