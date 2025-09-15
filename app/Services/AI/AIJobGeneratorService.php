<?php

namespace App\Services\AI;

interface AIJobGeneratorService
{
    /**
     * Generate an AI-assisted job posting draft from brief inputs.
     *
     * @param array $input Arbitrary structured inputs: title, seniority, requirements, etc.
     * @return array Structured draft payload suitable for JSON responses
     */
    public function generateJobDraft(array $input): array;
}
