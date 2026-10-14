<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Drupal at 25: How a Guestbook Became the Internet\'s Most Powerful CMS',
                'slug' => 'drupal-at-25-history',
                'excerpt' => 'From Dries Buytaert\'s university dorm room in 2000 to powering the White House, NASA, and thousands of enterprise platforms — the unlikely story of how Drupal became what it is.',
                'tags' => ['Drupal', 'History'],
                'featured' => true,
                'published_at' => now()->subDays(2),
                'content' => '<h2>A Dorm Room Project That Changed the Web</h2>
<p>In January 2001, a Belgian computer science student named Dries Buytaert released version 1.0.0 of a piece of software he originally built as a private message board for his dorm house at the University of Antwerp. He called it Drupal — a rough anglicisation of the Dutch word <em>druppel</em>, meaning "drop".</p>
<p>He almost kept it private. The decision to open-source it was casual, almost accidental. What followed was anything but.</p>
<h2>Drupal 1: What It Actually Was</h2>
<p>Drupal 1.0.0 was tiny — a few hundred lines of PHP running on a MySQL database. It had nodes, users, and a basic theming layer. There were no modules in the modern sense. Everything lived in a single codebase.</p>
<p>But the architecture had something rare for 2001: a hook system. Modules could alter behaviour without touching core. That single design decision — hooks — defined Drupal\'s extensibility for the next two decades.</p>
<blockquote>The hook system was the original sin and the original genius of Drupal. It made everything possible and everything complicated at the same time.</blockquote>
<h2>The Rise to Enterprise</h2>
<p>By Drupal 6 and 7, the platform had become the go-to choice for governments, universities, and media organisations that needed something more than WordPress but less than a custom build. The White House launched on Drupal 7 in 2009. So did the Grammy Awards, the Grammys, Warner Bros., and NASA.</p>
<p>What made Drupal compelling at enterprise scale:</p>
<ul>
<li><strong>Granular permissions</strong> — role-based access control that could be tuned to extremely specific editorial workflows</li>
<li><strong>Multilingual out of the box</strong> — by Drupal 8, content translation was a first-class feature, not an afterthought</li>
<li><strong>API-first architecture</strong> — the shift to Symfony components in D8 made Drupal a serious headless option</li>
</ul>
<h2>The Symfony Bet</h2>
<p>Drupal 8, released in 2015, was the most controversial version in the project\'s history. Dries and the community made a decision that alienated many longtime contributors: rebuild Drupal\'s internals on top of Symfony components.</p>
<p>The upgrade path from D7 to D8 was brutal. Modules had to be rewritten from scratch. Many agencies lost clients. Many developers left.</p>
<p>But the bet paid off. Drupal 8 brought dependency injection, proper OOP, REST APIs, and a migration path forward that finally matched what other modern frameworks offered. It positioned Drupal for the API-first, decoupled era that followed.</p>
<h2>Where Drupal Stands Today</h2>
<p>Drupal 10, released in December 2022, is built on Symfony 6 and PHP 8.1+. It\'s faster, more secure, and more developer-friendly than any previous version. The community has stabilised around a predictable release cadence — a major version every two years, with continuous innovation in minor releases.</p>
<p>The platforms running on Drupal today process billions of page views. The project that started as a guestbook now underpins some of the most complex content operations on the web.</p>
<p>Not bad for a druppel.</p>',
            ],
            [
                'title' => 'Upgrading from Drupal 10 to Drupal 11: What Actually Changes',
                'slug' => 'drupal-10-to-11-upgrade-guide',
                'excerpt' => 'Drupal 11 dropped PHP 8.1 support, removed deprecated APIs, and shipped with Symfony 7. Here\'s a practical guide to what the upgrade involves and how to approach it without breaking production.',
                'tags' => ['Drupal', 'Upgrade', 'PHP'],
                'featured' => false,
                'published_at' => now()->subDays(5),
                'content' => '<h2>The Good News First</h2>
<p>If your Drupal 10 site is well-maintained — meaning you\'ve been keeping up with minor releases and have addressed deprecation warnings — upgrading to Drupal 11 is the smoothest major version transition the project has ever had. The architectural fundamentals didn\'t change. The Symfony component layer is still there. The hook system still works (though events are increasingly preferred).</p>
<p>The bad news: if you\'ve been ignoring deprecation warnings, the upgrade will surface every one of them.</p>
<h2>What Actually Changed</h2>
<h3>PHP 8.2 Minimum</h3>
<p>Drupal 11 requires PHP 8.2 as the minimum version, dropping support for PHP 8.1. In practice, most hosting environments are already on 8.2+, but check your stack before starting.</p>
<pre><code>composer require drupal/core:^11 --update-with-dependencies</code></pre>
<h3>Symfony 7</h3>
<p>The upgrade from Symfony 6 to Symfony 7 is the most significant internal change. For most site builders and module developers, this is invisible. For anyone using Symfony components directly in custom code, review the Symfony 7 changelog for breaking changes — particularly around the HTTP client, security components, and console.</p>
<h3>Deprecated APIs Removed</h3>
<p>Any API that was deprecated in Drupal 10.x is gone in Drupal 11. The most commonly hit removals include:</p>
<ul>
<li><code>hook_node_access_records_alter()</code> signature changes</li>
<li>Several <code>\\Drupal\\Core\\Entity</code> method removals</li>
<li>Old-style plugin annotation formats (replaced by PHP attributes)</li>
<li>The <code>seven</code> and <code>bartik</code> themes (already removed in D10, but contrib modules sometimes referenced them)</li>
</ul>
<h3>CKEditor 5 Only</h3>
<p>CKEditor 4 support is fully removed. If you\'re still using it via contrib, migrate to CKEditor 5 before upgrading to D11.</p>
<h2>The Upgrade Process</h2>
<p>Here\'s the sequence I use for client upgrades:</p>
<ol>
<li><strong>Run the Upgrade Status module</strong> on the D10 site. Fix every deprecated API warning it surfaces — don\'t skip this step.</li>
<li><strong>Check contrib module compatibility</strong> via the D11 compatibility tracker at drupal.org. Most major modules have D11-compatible releases, but some smaller ones don\'t.</li>
<li><strong>Update your <code>composer.json</code></strong> to require <code>drupal/core:^11</code> and run <code>composer update</code> in a feature branch.</li>
<li><strong>Run <code>drush updb</code></strong> — D11 ships with several database updates that handle schema migrations automatically.</li>
<li><strong>Test thoroughly</strong> — particularly custom modules that use deprecated APIs, and anything touching the entity system.</li>
</ol>
<h2>Custom Module Checklist</h2>
<p>For each custom module, verify:</p>
<ul>
<li>No references to removed D10 deprecated code</li>
<li>Plugin definitions use PHP attributes (<code>#[Plugin\...]</code>) rather than annotation docblocks where the D11 attribute-based discovery is in play</li>
<li>Any direct Symfony service usage is compatible with Symfony 7</li>
</ul>
<blockquote>Run <code>drush cr && drush php:eval "drupal_check_module(\'your_module\')"</code> as a quick sanity check, but don\'t rely on it alone — it misses runtime deprecations.</blockquote>
<h2>Timeline Considerations</h2>
<p>Drupal 10 reaches end-of-life in January 2026. That\'s plenty of time to plan a migration, but "plenty of time" has a way of disappearing when you factor in agency schedules, client approvals, and contrib module readiness. Start the Upgrade Status audit now, even if you\'re not upgrading until next year.</p>',
            ],
            [
                'title' => 'Drupal in 2025: State of the Platform',
                'slug' => 'drupal-2025-state-of-the-platform',
                'excerpt' => 'Automatic Updates, Project Browser, the new Recipes system, and AI-powered site building — Drupal\'s roadmap for 2025 is the most ambitious since the Symfony rewrite.',
                'tags' => ['Drupal', 'News'],
                'featured' => false,
                'published_at' => now()->subDays(10),
                'content' => '<h2>The New Experience Initiative</h2>
<p>For most of its history, Drupal has been the professional\'s CMS — powerful, flexible, and notoriously difficult to get started with. DrupalCon 2024 signalled a deliberate shift: the project is investing heavily in making Drupal accessible to site builders who don\'t have a developer on retainer.</p>
<p>The three pillars of this effort are Automatic Updates, Project Browser, and Recipes.</p>
<h2>Automatic Updates</h2>
<p>Drupal has historically required a developer (or at minimum, Composer knowledge) to apply security updates. Automatic Updates, now shipping as a stable contributed module and heading toward core inclusion, changes this entirely.</p>
<p>The module handles Composer-based updates in the background, with a staged update process that tests compatibility before applying changes to production. For the thousands of Drupal sites that have fallen behind on security releases simply because no one remembered to run <code>composer update</code>, this is significant.</p>
<h2>Project Browser</h2>
<p>Installing a module in Drupal has always required leaving the admin UI, going to drupal.org, downloading a package, and running Composer. Project Browser puts a searchable module directory directly inside the Drupal admin, with one-click installation.</p>
<p>Combined with Automatic Updates, this brings Drupal\'s admin experience significantly closer to WordPress and Craft CMS in terms of ease of use — without sacrificing the underlying power of the Composer-based dependency system.</p>
<h2>Recipes: Composable Site Configurations</h2>
<p>Recipes are perhaps the most architecturally interesting addition to Drupal in years. A Recipe is a distributable, reusable bundle of configuration — content types, views, workflows, permissions — that can be applied to a Drupal site with a single command:</p>
<pre><code>drush recipe path/to/recipe</code></pre>
<p>Unlike Distributions (which are essentially full site templates that fork your codebase), Recipes are composable. You can apply a "Blog" recipe, then an "Events" recipe, then a "Media Library" recipe, combining them on a single site without conflict.</p>
<p>This has huge implications for agency work: standard client configurations — editorial workflows, media handling, multilingual setups — can be packaged as Recipes and applied in minutes instead of hours.</p>
<h2>Drupal CMS</h2>
<p>Building on top of Recipes, the Drupal Association launched <strong>Drupal CMS</strong> — a curated distribution that ships with a set of opinionated Recipes for common use cases. It\'s positioned as the "easy on-ramp" version of Drupal, comparable to WordPress.com or Squarespace in terms of initial accessibility, but with the full power of Drupal underneath.</p>
<h2>Looking Ahead</h2>
<p>Drupal 11.1 and 11.2 are continuing this trajectory with deeper AI integrations, more Recipes in core, and performance improvements driven by the switch to Symfony 7\'s HTTP client. The platform is in a genuinely exciting phase — not just maintaining relevance, but actively expanding what a CMS can do.</p>',
            ],
            [
                'title' => 'Building AI-Powered Drupal Sites: A Practical Overview',
                'slug' => 'ai-powered-drupal-sites',
                'excerpt' => 'From the AI module ecosystem to content generation, translation, and smart search — how Drupal developers are integrating LLMs into production platforms right now.',
                'tags' => ['Drupal', 'AI', 'LLMs'],
                'featured' => false,
                'published_at' => now()->subDays(14),
                'content' => '<h2>The AI Module Ecosystem</h2>
<p>Drupal\'s AI integration story starts with the <strong>AI module</strong> — a contrib project that provides a provider-agnostic abstraction layer for connecting Drupal to LLM APIs. Rather than building OpenAI or Anthropic dependencies directly into your custom modules, the AI module gives you a unified interface:</p>
<pre><code>$ai_provider = \Drupal::service(\'ai.provider\');
$response = $ai_provider->chat(\'openai\', \'gpt-4o\', [
    [\'role\' => \'user\', \'content\' => \'Summarise this article: \' . $node->body->value],
]);</code></pre>
<p>Swap the provider from <code>openai</code> to <code>anthropic</code> or <code>mistral</code> and the rest of your code stays unchanged. This is the right abstraction for enterprise Drupal work, where provider lock-in is a real concern.</p>
<h2>Content Generation Workflows</h2>
<p>The most immediate practical use case is content assistance in the editorial interface. The <strong>AI Interpolator</strong> module (built on top of the AI module) lets editors trigger AI actions directly from content forms:</p>
<ul>
<li>Generate a summary from a long article body</li>
<li>Suggest SEO meta descriptions based on the page content</li>
<li>Auto-tag content based on a taxonomy vocabulary</li>
<li>Translate field values using an LLM when a formal translation service isn\'t available</li>
</ul>
<p>These workflows keep editors in the Drupal admin rather than switching between tools, and the outputs are always suggestions — editors retain full control over what gets published.</p>
<h2>Smart Search with Vector Embeddings</h2>
<p>Standard Drupal search (Apache Solr or Elasticsearch via Search API) does keyword matching. It\'s good for exact queries but fails on semantic search — "articles about scaling Drupal" won\'t find content that never uses the word "scaling".</p>
<p>Vector search changes this. The workflow:</p>
<ol>
<li>On content save, generate an embedding for the node body using an embeddings API (OpenAI <code>text-embedding-3-small</code> is cost-effective)</li>
<li>Store the embedding in a vector database (pgvector works well if you\'re already on PostgreSQL; Pinecone or Weaviate for dedicated vector storage)</li>
<li>At search time, embed the query and find the nearest neighbours by cosine similarity</li>
</ol>
<p>This is non-trivial to implement cleanly in Drupal, but the Search API Vector Search module is making it progressively easier.</p>
<h2>AI-Assisted Code Review in Drupal Modules</h2>
<p>Beyond the editorial layer, LLMs are changing how Drupal developers work. I\'ve been using Claude and Copilot for:</p>
<ul>
<li>Reviewing hook implementations for edge cases I might have missed</li>
<li>Generating test stubs for custom modules (PHPUnit + KernelTestBase)</li>
<li>Explaining unfamiliar Drupal APIs — the hook and plugin system has a lot of surface area, and LLMs are generally well-trained on the drupal.org documentation</li>
</ul>
<blockquote>The LLM doesn\'t know your specific business logic, but it knows the Drupal API surface extremely well. Use it for the "how do I do X in Drupal" questions and write the business logic yourself.</blockquote>
<h2>What to Watch</h2>
<p>The Drupal AI initiative is moving fast. The roadmap includes deeper integration with the CKEditor 5 toolbar (AI-assisted writing inline), automatic alt-text generation for the Media Library, and an AI-powered site building assistant that can scaffold content types from a plain-English description. The foundation is solid — the next 18 months will be interesting.</p>',
            ],
            [
                'title' => 'LLMs for Developers: What\'s Actually Useful After the Hype',
                'slug' => 'llms-for-developers-practical-guide',
                'excerpt' => 'Two years of daily LLM use in a PHP/Drupal development workflow. What works, what wastes time, and the mental model that makes AI tools genuinely useful rather than occasionally impressive.',
                'tags' => ['AI', 'LLMs', 'Developer Tools'],
                'featured' => false,
                'published_at' => now()->subDays(20),
                'content' => '<h2>The Hype Hangover Is Real</h2>
<p>After the initial wave of "AI will replace developers" think-pieces and the subsequent "actually it\'s useless" backlash, most working developers have settled somewhere in the middle: LLMs are genuinely useful tools that require skill to use well, and they\'re particularly good at specific things that aren\'t always obvious at first.</p>
<p>Here\'s what two years of daily use in a PHP/Drupal workflow has taught me.</p>
<h2>The Mental Model That Changed Everything</h2>
<p>The most useful reframe: <strong>LLMs are a search engine for code knowledge, not a code generator</strong>.</p>
<p>When I use Claude or GPT-4 well, I\'m not asking it to write code for me. I\'m asking it to surface relevant knowledge — APIs I don\'t know, patterns I haven\'t encountered, edge cases I haven\'t considered. Then I write the actual code myself, informed by what I learned.</p>
<p>When I use LLMs badly, I\'m asking them to generate large blocks of code and pasting them in without really understanding them. This produces bugs I can\'t diagnose and technical debt I don\'t notice until later.</p>
<h2>What Actually Works Well</h2>
<h3>API Discovery</h3>
<p>Drupal has thousands of hooks, services, and plugin types. Nobody memorises all of them. Asking "what\'s the Drupal 10 way to alter entity queries programmatically?" gets me to the right hook or service in 30 seconds versus 5 minutes of documentation archaeology.</p>
<h3>Code Review</h3>
<p>Pasting a custom module into Claude and asking "are there any security issues here?" or "what edge cases am I missing?" surfaces problems I\'d otherwise catch in production. It\'s particularly good at spotting:</p>
<ul>
<li>Missing access checks</li>
<li>Unsanitised user input</li>
<li>N+1 query patterns</li>
<li>Incorrect cache tag declarations</li>
</ul>
<h3>Writing Tests</h3>
<p>Writing PHPUnit tests for Drupal modules is tedious. LLMs handle the scaffolding well — generating the test class structure, mock setups, and data providers — leaving me to fill in the actual assertions.</p>
<h3>Explaining Unfamiliar Code</h3>
<p>When I inherit a codebase with unusual patterns, asking an LLM to explain a specific section is faster than reading documentation and often more contextual.</p>
<h2>What Doesn\'t Work</h2>
<h3>Long-Context Generation</h3>
<p>Asking an LLM to write an entire Drupal module from scratch produces something plausible-looking that usually has subtle bugs in the Drupal-specific parts — incorrect hook signatures, wrong service container usage, outdated API calls. The longer the output, the more likely it is to introduce errors.</p>
<h3>Anything With a Knowledge Cutoff Problem</h3>
<p>LLMs have training cutoffs. Drupal 10 and 11 APIs, particularly newer features like Recipes and the AI module, are poorly represented in training data. Always verify AI-generated Drupal code against the actual drupal.org documentation.</p>
<h3>Architecture Decisions</h3>
<p>LLMs will confidently suggest architectural patterns for your specific business problem without understanding your constraints. Use them to generate options, not to make decisions.</p>
<h2>The Practical Workflow</h2>
<p>My current workflow:</p>
<ol>
<li>For new features: sketch the approach myself, then ask the LLM to critique it and suggest alternatives I haven\'t considered</li>
<li>For unfamiliar APIs: ask the LLM for the right hook/service/plugin type, then verify against drupal.org docs</li>
<li>For debugging: paste the error + relevant code, ask for hypotheses — it\'s usually right on the first or second suggestion</li>
<li>For tests: generate the scaffold, write the assertions manually</li>
</ol>
<p>The throughput improvement is real. Not because the AI writes code for me, but because it eliminates the lookup-and-context-switch overhead that breaks flow state.</p>',
            ],
            [
                'title' => 'Context Window Sizes in 2025: What They Mean for Developer Workflows',
                'slug' => 'llm-context-windows-developer-workflows',
                'excerpt' => 'Claude can now hold 200K tokens in context. GPT-4o goes to 128K. What do these numbers actually mean for day-to-day development, and when does a bigger context window stop helping?',
                'tags' => ['AI', 'LLMs'],
                'featured' => false,
                'published_at' => now()->subDays(25),
                'content' => '<h2>What Is a Context Window, Actually?</h2>
<p>A context window is the amount of text an LLM can "see" at once — both the input you provide and the output it generates. Everything outside the context window is invisible to the model. It has no memory of previous conversations unless you explicitly include them.</p>
<p>In early GPT-3 deployments, context windows were around 4,000 tokens (roughly 3,000 words). Today, Claude 3.5 Sonnet supports 200,000 tokens — about 150,000 words, or a full-length novel.</p>
<h2>Why This Matters for Developers</h2>
<p>For code work, the context window limit determines:</p>
<ul>
<li>How much of your codebase you can include in a prompt</li>
<li>How long a conversation you can have before the model "forgets" early context</li>
<li>Whether you can paste an entire file vs. needing to selectively include relevant sections</li>
</ul>
<p>In practical terms, going from 4K to 128K tokens changed LLM-assisted development from "useful for snippets" to "useful for entire modules." Going from 128K to 200K+ is more incremental, but still meaningful for very large codebases.</p>
<h2>The Useful Range for Development Tasks</h2>
<p>From my experience, most development tasks fit comfortably in 8–16K tokens:</p>
<ul>
<li>A single Drupal module (custom code only): typically 2–10K tokens</li>
<li>A set of related module files + the relevant Drupal core APIs: 10–30K tokens</li>
<li>An entire small application: 30–100K tokens</li>
</ul>
<p>The 200K window becomes relevant when you need to reason across an entire large application — reviewing a pull request that touches 50 files, understanding how data flows through a complex system, or debugging an issue that requires seeing both the module that produces data and the module that consumes it.</p>
<h2>The Needle-in-a-Haystack Problem</h2>
<p>Larger context windows come with a known limitation: models perform worse at retrieving information from the middle of a very long context than from the beginning or end. This is called the "lost in the middle" problem.</p>
<p>Practically: if you dump 150K tokens of code into a prompt and the relevant section is in the middle, the model may produce a less accurate response than if you\'d trimmed the context to include only what\'s relevant.</p>
<blockquote>More context isn\'t always better. The best prompt includes exactly what the model needs to answer accurately — no more, no less.</blockquote>
<h2>Retrieval-Augmented Generation for Large Codebases</h2>
<p>For very large codebases where even 200K tokens isn\'t enough, the emerging solution is RAG (Retrieval-Augmented Generation): embed your codebase as vectors, retrieve the semantically relevant sections at query time, and inject only those sections into the LLM\'s context.</p>
<p>Tools like Continue.dev and Cursor implement this automatically. The result is that the LLM "knows" your entire codebase even when it can\'t fit in a single context window — because the retrieval system surfaces the right pieces on demand.</p>
<h2>What to Actually Do With This</h2>
<p>For most day-to-day Drupal development, you don\'t need to think about context limits — individual module files and the associated tests comfortably fit in any modern LLM\'s window.</p>
<p>Where it matters: when debugging cross-module issues, doing architecture reviews of large systems, or trying to understand an inherited codebase. In these cases, choosing a model with a larger context window (Claude or GPT-4o over smaller models) and being deliberate about what you include in your prompt will meaningfully improve output quality.</p>',
            ],
            [
                'title' => 'Drupal Custom Module Development: Patterns I Actually Use',
                'slug' => 'drupal-custom-module-patterns',
                'excerpt' => 'After nine years of Drupal module development, here are the architectural patterns, service container approaches, and testing strategies I reach for on every project.',
                'tags' => ['Drupal', 'PHP', 'Architecture'],
                'featured' => false,
                'published_at' => now()->subDays(35),
                'content' => '<h2>Services Over Procedural Code</h2>
<p>The single biggest quality-of-life improvement in Drupal 8+ over Drupal 7 was the service container. Instead of global functions and static calls, logic lives in injectable services.</p>
<p>I define a service for any non-trivial business logic:</p>
<pre><code># mymodule.services.yml
services:
  mymodule.content_processor:
    class: Drupal\mymodule\ContentProcessor
    arguments:
      - \'@entity_type.manager\'
      - \'@logger.factory\'</code></pre>
<p>And inject it via constructor injection in controllers, form handlers, and other services. The benefits — testability, single responsibility, clear dependency graphs — are worth the extra file.</p>
<h2>Event Subscribers Over Hooks (When Appropriate)</h2>
<p>Drupal still uses hooks extensively, and for many things (altering forms, modifying entity queries, reacting to cron) hooks are the right tool. But for reacting to Drupal core events, Symfony event subscribers are cleaner and more explicit:</p>
<pre><code>class ContentAccessSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents(): array {
        return [KernelEvents::REQUEST => [\'onRequest\', 20]];
    }

    public function onRequest(RequestEvent $event): void {
        // Logic here
    }
}</code></pre>
<p>Event subscribers are easier to test, easier to reason about, and their priority system is more explicit than hook weight.</p>
<h2>Entity API: Always Use the Storage Layer</h2>
<p>One of the most common mistakes I see in inherited Drupal codebases is direct database queries for entity data:</p>
<pre><code>// Bad — bypasses entity cache, access checks, field API
$result = \Drupal::database()->query(\'SELECT nid FROM {node} WHERE type = :type\', [\':type\' => \'article\']);</code></pre>
<p>Always use the entity storage layer:</p>
<pre><code>// Good
$nids = \Drupal::entityQuery(\'node\')
  ->condition(\'type\', \'article\')
  ->condition(\'status\', 1)
  ->accessCheck(TRUE)
  ->execute();

$nodes = \Drupal::entityTypeManager()->getStorage(\'node\')->loadMultiple($nids);</code></pre>
<p>The entity layer handles caching, access checks, and field value formatting. Bypassing it creates subtle bugs that only appear in multi-role environments or when cache invalidation matters.</p>
<h2>Cache Tags: Be Explicit</h2>
<p>Drupal\'s cache tag system is one of its superpowers, and most custom modules underutilise it. Any custom render array or response that depends on entity data should declare its cache tags explicitly:</p>
<pre><code>$build[\'#cache\'][\'tags\'] = Cache::mergeTags(
    $node->getCacheTags(),
    [\'node_list:article\']
);</code></pre>
<p>The <code>node_list:article</code> tag gets invalidated whenever any article node is created, updated, or deleted — so your render array automatically invalidates without manual intervention.</p>
<h2>Kernel Tests for Services, Functional Tests for User Flows</h2>
<p>The test type hierarchy I use:</p>
<ul>
<li><strong>Unit tests</strong> (PHPUnit, no Drupal bootstrap): for pure PHP logic, value objects, utility functions</li>
<li><strong>Kernel tests</strong> (KernelTestBase, partial Drupal bootstrap): for services, hooks, entity operations — fastest test type that still verifies Drupal integration</li>
<li><strong>Functional tests</strong> (BrowserTestBase, full bootstrap): for end-to-end user flows, form submissions, access control</li>
</ul>
<p>Most custom module logic should be covered by Kernel tests. They\'re fast enough to run on every commit and cover the majority of real-world failure modes.</p>
<blockquote>A Kernel test that takes 500ms gives you more confidence than a Functional test that takes 5 seconds and tests the same underlying logic.</blockquote>
<h2>The Module Structure I Always Start With</h2>
<pre><code>mymodule/
  src/
    Controller/
    Form/
    Plugin/Block/
    Service/
    EventSubscriber/
  tests/
    src/
      Unit/
      Kernel/
      Functional/
  mymodule.info.yml
  mymodule.services.yml
  mymodule.module        # Hooks only — business logic in services
  mymodule.routing.yml
  mymodule.links.menu.yml</code></pre>
<p>The <code>.module</code> file should be thin — just hook implementations that delegate immediately to service calls. Logic belongs in classes, not procedural functions.</p>',
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
