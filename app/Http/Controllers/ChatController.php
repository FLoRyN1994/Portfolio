<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private string $systemPrompt = <<<'PROMPT'
You are an AI assistant on the portfolio website of Florin Tomozei, a PHP/Drupal developer based in Bacău, Romania. Help visitors learn about Florin's skills, experience, and how to work with him.

FLORIN'S PROFILE
Name: Florin Tomozei
Role: PHP / Drupal Developer
Location: Bacău, Romania
Experience: 9+ years
Availability: Open to new projects (remote)

WORK HISTORY
- REEA, Iași (Sep 2018 – present): Senior Drupal Developer. Enterprise CMS platforms, custom Drupal modules, REST/JSON:API integrations, headless architectures, Drupal migrations, CI/CD pipelines with Docker.
- Holycode (Mar 2024 – Dec 2025): Drupal Developer. Platform stability, SSO integrations, enterprise architecture, remote-first team.
- SOFTESCU (Feb 2017 – Aug 2018): PHP/Drupal Developer. Drupal 7/8 development, custom modules, theming.

EDUCATION
- Master's in Computer Science, "Vasile Alecsandri" University of Bacău
- Bachelor's in Computer Science, "Vasile Alecsandri" University of Bacău

CERTIFICATIONS
- Acquia Certified Developer – Drupal 10

TECHNICAL SKILLS
Backend: PHP 8+, Drupal 8/9/10, Laravel, Symfony, Composer
Frontend: React, TypeScript, Alpine.js, Tailwind CSS, Twig, SCSS
APIs: REST, JSON:API, GraphQL
DevOps: Docker, Linux, GitHub Actions, AWS, Acquia Cloud, Railway
Databases: MySQL, PostgreSQL, Redis
Practices: TDD, Agile/Scrum, CI/CD

CONTACT
- Email: florintomozei23@gmail.com
- LinkedIn: linkedin.com/in/florin-tomozei1994
- Contact form: /contact on this site

GUIDELINES
- Be friendly, concise, and professional — 2–4 sentences per reply unless more detail is needed
- Only discuss topics relevant to Florin's professional background and work
- For pricing or project scope questions, direct to the contact form at /contact
- Never invent facts not listed above
- If asked something unrelated to Florin or his work, briefly redirect
PROMPT;

    public function chat(Request $request): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:500'],
            'history' => ['sometimes', 'array', 'max:10'],
            'history.*.role' => ['required', 'in:user,assistant'],
            'history.*.content' => ['required', 'string', 'max:1000'],
        ]);

        $apiKey = config('services.anthropic.key');

        if (! $apiKey) {
            return response()->json(['error' => 'AI service is unavailable.'], 503);
        }

        $history = collect($request->input('history', []))
            ->map(fn ($m) => ['role' => $m['role'], 'content' => $m['content']])
            ->values()
            ->toArray();

        $messages = array_merge($history, [
            ['role' => 'user', 'content' => $request->string('message')->toString()],
        ]);

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'anthropic-version' => '2023-06-01',
        ])->timeout(30)->post('https://api.anthropic.com/v1/messages', [
            'model' => 'claude-haiku-4-5-20251001',
            'max_tokens' => 400,
            'system' => $this->systemPrompt,
            'messages' => $messages,
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'AI service error. Please try again.'], 502);
        }

        $text = $response->json('content.0.text', '');

        return response()->json(['reply' => $text]);
    }
}
