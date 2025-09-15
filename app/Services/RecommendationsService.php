<?php

namespace App\Services;

class RecommendationsService
{
    /**
     * Return job recommendations for the given user.
     * Placeholder implementation keeps contract: { data: [] }.
     */
    public function listForUser(?int $user_id): array
    {
        return ['data' => []];
    }
}
