<?php

namespace App\Services\AI;

interface AIResumeGeneratorService
{
    /**
     * Generate an AI-assisted resume draft from provided user inputs.
     *
     * @param array $input Arbitrary structured inputs: work_history, education, skills, etc.
     * @return array Structured draft payload suitable for JSON responses
     */
    public function generateResumeDraft(array $input): array;
}
