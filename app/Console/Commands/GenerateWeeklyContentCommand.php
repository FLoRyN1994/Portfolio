<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\TilPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateWeeklyContentCommand extends Command
{
    protected $signature = 'content:generate-weekly {--dry-run}';

    protected $description = 'Generate one blog post and one TIL entry via the Anthropic API and publish them';

    private string $systemPrompt = <<<'PROMPT'
You are ghostwriting for Florin Tomozei, a senior PHP/Drupal developer (9+ years, Acquia Certified Developer – Drupal 10/11) who also works with Laravel and modern AI/LLM developer tooling. You write for his personal portfolio blog and "Today I Learned" (TIL) section.

Voice and style:
- First-person, practical, experience-based. No marketing fluff, no generic AI-blog tone.
- Technical precision over breadth — real code examples, real trade-offs, specific version numbers.
- Topics rotate across: Drupal 11.x internals and ecosystem, Laravel 11/12/13 features and patterns, and AI/LLM developer tooling (prompting, context windows, agentic coding workflows, model capabilities).
- Never repeat a topic from the "existing content" list given to you — pick something adjacent but genuinely new.

Output format — respond with ONLY a single valid JSON object, no markdown fences, no prose before or after:
{
  "blog": {
    "title": "string",
    "slug": "kebab-case-string",
    "excerpt": "1-2 sentence summary, used as a card preview",
    "tags": ["Tag1", "Tag2"],
    "content": "HTML string using <h2>, <p>, <ul>/<li>, <pre><code>, <blockquote> tags — 500-900 words"
  },
  "til": {
    "title": "string",
    "slug": "kebab-case-string",
    "tags": ["Tag1", "Tag2"],
    "content": "Markdown string: 1-2 short paragraphs plus one fenced code block (```lang ... ```) — 100-250 words total"
  }
}

The blog post and TIL entry must cover two DIFFERENT topics from each other.
PROMPT;

    public function handle(): int
    {
        $apiKey = config('services.anthropic.key');

        if (! $apiKey) {
            $this->error('ANTHROPIC_API_KEY is not configured.');

            return self::FAILURE;
        }

        $existingTitles = Post::pluck('title')
            ->merge(TilPost::pluck('title'))
            ->implode("\n- ");

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'anthropic-version' => '2023-06-01',
        ])->timeout(120)->post('https://api.anthropic.com/v1/messages', [
            'model' => 'claude-sonnet-4-6',
            'max_tokens' => 4000,
            'system' => $this->systemPrompt,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Existing content (do not repeat these topics):\n- {$existingTitles}\n\nGenerate this week's blog post and TIL entry now.",
                ],
            ],
        ]);

        if ($response->failed()) {
            $this->error('Anthropic API request failed: '.$response->body());
            Log::error('content:generate-weekly API failure', ['body' => $response->body()]);

            return self::FAILURE;
        }

        $text = trim($response->json('content.0.text', ''));
        $text = preg_replace('/^```(?:json)?\s*|\s*```$/', '', $text);
        $data = json_decode($text, true);

        if (! is_array($data) || ! isset($data['blog'], $data['til'])) {
            $this->error('Could not parse a valid JSON response from the model.');
            Log::error('content:generate-weekly parse failure', ['raw' => $text]);

            return self::FAILURE;
        }

        $blog = $data['blog'];
        $til = $data['til'];

        $blog['slug'] = $this->uniqueSlug(Post::class, $blog['slug'] ?? Str::slug($blog['title']));
        $til['slug'] = $this->uniqueSlug(TilPost::class, $til['slug'] ?? Str::slug($til['title']));

        if ($this->option('dry-run')) {
            $this->info('--- BLOG ---');
            $this->line(json_encode($blog, JSON_PRETTY_PRINT));
            $this->info('--- TIL ---');
            $this->line(json_encode($til, JSON_PRETTY_PRINT));

            return self::SUCCESS;
        }

        Post::create([
            'title' => $blog['title'],
            'slug' => $blog['slug'],
            'excerpt' => $blog['excerpt'] ?? '',
            'content' => $blog['content'] ?? '',
            'tags' => $blog['tags'] ?? [],
            'featured' => false,
            'published_at' => now(),
        ]);

        TilPost::create([
            'title' => $til['title'],
            'slug' => $til['slug'],
            'content' => $til['content'] ?? '',
            'tags' => $til['tags'] ?? [],
            'published_at' => now(),
        ]);

        $this->info("Published blog post: {$blog['title']}");
        $this->info("Published TIL entry: {$til['title']}");

        return self::SUCCESS;
    }

    private function uniqueSlug(string $model, string $slug): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $i = 2;

        while ($model::where('slug', $candidate)->exists()) {
            $candidate = "{$base}-{$i}";
            $i++;
        }

        return $candidate;
    }
}
