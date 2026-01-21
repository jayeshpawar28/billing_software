<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function analyze(Request $request, GeminiService $gemini)
    {
        $request->validate([
            'resume_text' => 'required',
            'job_role' => 'required'
        ]);

        $output = $gemini->analyzeResume($request->resume_text, $request->job_role);

        $data = json_decode($output, true);

        return view('analysis', compact('data'));
    }
}
