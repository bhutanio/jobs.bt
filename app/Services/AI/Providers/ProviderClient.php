<?php

namespace App\Services\AI\Providers;

use App\Services\AI\AIJobGeneratorService;
use App\Services\AI\AIResumeGeneratorService;

class ProviderClient implements AIResumeGeneratorService, AIJobGeneratorService
{
    public function generateResumeDraft(array $input): array
    {
        // Simple placeholder implementation: echo back skills and sections
        return [
            'draft' => 'Generated resume draft',
            'input' => $input,
        ];
    }

    public function generateJobDraft(array $input): array
    {
        return [
            'draft' => 'Generated job posting draft',
            'input' => $input,
        ];
    }
}
