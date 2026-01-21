<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    /**
     * List available models (for debugging)
     */
    public function listModels()
    {
        $apiKey = env('GEMINI_API_KEY');
        
        $response = Http::withoutVerifying()->get(
            "https://generativelanguage.googleapis.com/v1/models?key=$apiKey"
        );
        
        return $response->json();
    }

    public function analyzeResume($resumeText, $jobRole)
    {
        $apiKey = env('GEMINI_API_KEY');

        $prompt = "
        You are an ATS Resume Analyzer.
        Analyze the resume for the role: $jobRole.
        Return JSON with:
        - skills
        - missing_keywords
        - strengths
        - weaknesses
        - ats_score
        - resume_score
        - suggestions
        - improved_resume_text
        Resume:
        $resumeText
        ";

        $response = Http::withoutVerifying()->post(
            "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=$apiKey",
            [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $prompt]
                        ]
                    ]
                ]
            ]
        );

        // Check for errors
        if ($response->failed()) {
            $error = $response->json();
            throw new \Exception('Gemini API Error: ' . ($error['error']['message'] ?? 'Unknown error'));
        }

        $responseData = $response->json();
        
        // Check if response has the expected structure
        if (!isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            throw new \Exception('Unexpected response structure from Gemini API');
        }

        return $responseData['candidates'][0]['content']['parts'][0]['text'];
    }
}
