<?php

namespace Database\Seeders;

use App\Models\TilPost;
use Illuminate\Database\Seeder;

class TilPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'PHP 8.2 readonly classes eliminate DTO boilerplate',
                'slug'  => 'php-82-readonly-classes',
                'content' => 'Before PHP 8.2, marking a DTO as immutable meant writing `readonly` on every single property. Now you can put it on the class itself and it applies to all instance properties automatically.' . "\n\n" .
'```php' . "\n" .
'// PHP 8.1 — verbose' . "\n" .
'class UserDTO {' . "\n" .
'    public function __construct(' . "\n" .
'        public readonly string $name,' . "\n" .
'        public readonly string $email,' . "\n" .
'        public readonly int    $role,' . "\n" .
'    ) {}' . "\n" .
'}' . "\n\n" .
'// PHP 8.2 — one keyword covers all properties' . "\n" .
'readonly class UserDTO {' . "\n" .
'    public function __construct(' . "\n" .
'        public string $name,' . "\n" .
'        public string $email,' . "\n" .
'        public int    $role,' . "\n" .
'    ) {}' . "\n" .
'}' . "\n" .
'```' . "\n\n" .
'Two caveats: all properties must be typed (no dynamic properties allowed), and readonly cannot be used on enums, traits, or interfaces. Came up on a Drupal project where we pass config objects between services — cuts the noise considerably.',
                'tags'         => ['PHP', 'PHP 8.2', 'OOP'],
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'PHP 8.3 #[Override] catches silent method drift at class load time',
                'slug'  => 'php-83-override-attribute',
                'content' => 'The `#[Override]` attribute tells PHP a method is intentionally overriding a parent. If the parent method is ever renamed or removed, PHP throws a fatal error at class load time — no more silent failures where your override quietly does nothing.' . "\n\n" .
'```php' . "\n" .
'class Base {' . "\n" .
'    public function process(): void { /* ... */ }' . "\n" .
'}' . "\n\n" .
'class Child extends Base {' . "\n" .
'    #[Override]' . "\n" .
'    public function process(): void { /* safe */ }' . "\n\n" .
'    #[Override]' . "\n" .
'    public function prcess(): void { /* Fatal: typo caught immediately */ }' . "\n" .
'}' . "\n" .
'```' . "\n\n" .
"Hit the silent failure case several times during Drupal major version upgrades where a core hook or interface method was renamed between versions. This attribute would have caught those instantly.",
                'tags'         => ['PHP', 'PHP 8.3', 'OOP'],
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'PHP 8.3 json_validate() skips allocating the decoded structure',
                'slug'  => 'php-83-json-validate',
                'content' => 'Before 8.3, validating a JSON string meant decoding it and checking `json_last_error()`. That parses and allocates the full structure even if you only care whether it is valid.' . "\n\n" .
'```php' . "\n" .
'// old — allocates the entire decoded structure' . "\n" .
'$data = json_decode($input);' . "\n" .
'if (json_last_error() !== JSON_ERROR_NONE) { /* invalid */ }' . "\n\n" .
'// PHP 8.3 — validation only, no allocation' . "\n" .
'if (!json_validate($input)) { /* invalid */ }' . "\n" .
'```' . "\n\n" .
'Useful at API boundaries where you want a quick validity gate before passing the string deeper into the system. On a high-traffic Drupal REST endpoint we were decoding just to immediately re-encode — `json_validate()` let us short-circuit that.',
                'tags'         => ['PHP', 'PHP 8.3', 'Performance'],
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Drupal cache tags: node_list vs node:N — picking the right scope',
                'slug'  => 'drupal-cache-tags-node-list-vs-node',
                'content' => 'Drupal cache tags follow the pattern `thing:identifier` for specific items and `thing_list` for collections. Using the wrong one either over-invalidates (performance) or under-invalidates (stale data).' . "\n\n" .
'```php' . "\n" .
'// Too broad — clears on every node save across the whole site' . "\n" .
'$build[\'#cache\'][\'tags\'][] = \'node_list\';' . "\n\n" .
'// Better — clears only when article nodes change (Drupal 9.1+)' . "\n" .
'$build[\'#cache\'][\'tags\'][] = \'node_list:article\';' . "\n\n" .
'// Best — clears only when this specific node changes' . "\n" .
'$build[\'#cache\'][\'tags\'][] = \'node:\' . $node->id();' . "\n" .
'```' . "\n\n" .
'Use `node_list:BUNDLE` when rendering a listing of a specific content type. Reserve `node_list` for genuinely site-wide queries. The bundle-scoped variant was quietly added in Drupal 9.1 and is underused.',
                'tags'         => ['Drupal', 'Caching', 'Performance'],
                'published_at' => now()->subDays(11),
            ],
            [
                'title' => 'Read X-Drupal-Cache-Tags to debug why a page clears too often',
                'slug'  => 'drupal-cache-tags-header-debug',
                'content' => 'When a Drupal page is served from cache, the response includes an `X-Drupal-Cache-Tags` header listing every tag attached to that response. It is the fastest way to see what is driving cache clears without adding instrumentation.' . "\n\n" .
'```bash' . "\n" .
'curl -sI https://example.com/page | grep -i cache-tags' . "\n" .
'# X-Drupal-Cache-Tags: block_view config:block.block.search node:42 node_list user:0' . "\n" .
'```' . "\n\n" .
'If you see `node_list` on a page that renders a single node, something upstream is running a list query where a specific tag would do. If you expect a tag but it is missing, the render element is not declaring it — add it manually via `$build[\'#cache\'][\'tags\']`. Enable `$settings[\'http.response.debug_cacheability_headers\'] = TRUE;` in `settings.local.php` to see these headers in development.',
                'tags'         => ['Drupal', 'Caching', 'Debugging'],
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'drush sql:sanitize before sharing any database dump',
                'slug'  => 'drush-sql-sanitize',
                'content' => '`drush sql:sanitize` scrubs a Drupal database of PII before sharing it — replaces user emails with safe placeholders and resets passwords. It should be a mandatory step before sending a production dump to any developer or staging environment.' . "\n\n" .
'```bash' . "\n" .
'drush @prod sql:dump > prod.sql' . "\n" .
'drush sql:drop && drush sql:cli < prod.sql' . "\n" .
'drush sql:sanitize --sanitize-password=drupal' . "\n" .
'```' . "\n\n" .
'By default it sets all user emails to `user+[uid]@localhost`. Extend it with `hook_sanitize_sql_database()` to scrub custom tables — important if you store personal data outside the core user table. Added this to every deployment pipeline we run at REEA.',
                'tags'         => ['Drupal', 'Drush', 'Security'],
                'published_at' => now()->subDays(17),
            ],
            [
                'title' => 'drush watchdog:tail streams the Drupal log in real time',
                'slug'  => 'drush-watchdog-tail',
                'content' => '`drush watchdog:tail` polls the Drupal watchdog and streams new entries to the terminal as they appear — like `tail -f` on a log file but for the database log.' . "\n\n" .
'```bash' . "\n" .
'# stream all entries' . "\n" .
'drush watchdog:tail' . "\n\n" .
'# filter by severity and channel' . "\n" .
'drush watchdog:tail --severity=error --type=php' . "\n\n" .
'# on a remote alias with full backtraces' . "\n" .
'drush @prod watchdog:tail --severity=notice --extended' . "\n" .
'```' . "\n\n" .
'Most useful when debugging a failing cron job or a Drush migration — run the operation in one terminal tab and watch the log stream in another. Much faster than repeatedly hitting the Reports UI or running `drush watchdog:show`.',
                'tags'         => ['Drupal', 'Drush', 'Debugging'],
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'drush php:eval runs arbitrary PHP in a fully bootstrapped Drupal',
                'slug'  => 'drush-php-eval',
                'content' => '`drush php:eval` executes a PHP snippet with full Drupal bootstrap — all services, entities, and APIs available — without writing a throwaway script file.' . "\n\n" .
'```bash' . "\n" .
'# inspect a config value on production' . "\n" .
'drush eval "print_r(\\Drupal::config(\'system.site\')->get(\'name\'));"' . "\n\n" .
'# check a service is registered' . "\n" .
'drush eval "var_dump(\\Drupal::hasService(\'my_module.processor\'));"' . "\n\n" .
'# push an item onto a queue' . "\n" .
'drush eval "\\Drupal::service(\'queue\')->get(\'my_queue\')->createItem([\'nid\' => 42]);"' . "\n" .
'```' . "\n\n" .
'I reach for this constantly during deployments to verify state after `drush deploy` — checking that config landed correctly, a service is wired, or a specific entity exists — all without touching the UI.',
                'tags'         => ['Drupal', 'Drush', 'Productivity'],
                'published_at' => now()->subDays(23),
            ],
            [
                'title' => 'Config Split: activate splits via settings.php, never commit them as active',
                'slug'  => 'drupal-config-split-settings-php',
                'content' => 'Config Split stores its own activation state inside config files. If you run `drush cex` while a split is active and commit the result, that split is baked into the repo as active — potentially enabling dev modules on production after the next deploy.' . "\n\n" .
'The safe pattern is to force activation through the config override system in `settings.php`, leaving the exported config always showing `status: false`.' . "\n\n" .
'```php' . "\n" .
'// settings.local.php (development only)' . "\n" .
'$config[\'config_split.config_split.dev\'][\'status\'] = TRUE;' . "\n\n" .
'// settings.php (production — or just omit the override entirely)' . "\n" .
'$config[\'config_split.config_split.dev\'][\'status\'] = FALSE;' . "\n" .
'```' . "\n\n" .
'This way the repo never carries environment-specific activation state. The deployment artifact is clean and `drush cim` on any environment will do the right thing.',
                'tags'         => ['Drupal', 'Configuration', 'DevOps'],
                'published_at' => now()->subDays(27),
            ],
            [
                'title' => 'Invalidate Drupal cache tags programmatically without triggering a full entity save',
                'slug'  => 'drupal-invalidate-cache-tags-programmatically',
                'content' => 'When you sync external data into Drupal — from an API, a migration, or a cron job — you often need to bust cached displays without performing a full entity save (which fires hooks, reindexes search, etc.). Cache tag invalidation lets you do this surgically.' . "\n\n" .
'```php' . "\n" .
'use Drupal\\Core\\Cache\\Cache;' . "\n\n" .
'// Static helper — hits every cache bin simultaneously' . "\n" .
'Cache::invalidateTags([\'node:5\', \'node_list:article\']);' . "\n\n" .
'// Via the service container (useful inside injected services)' . "\n" .
'$this->cacheTagsInvalidator->invalidateTags([\'product_feed\']);' . "\n" .
'```' . "\n\n" .
'We use a custom `product_feed` tag on every block that renders external product data. After each API sync cron run we call `Cache::invalidateTags([\'product_feed\'])` and only those blocks re-render — nothing else is touched.',
                'tags'         => ['Drupal', 'Caching', 'PHP'],
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => 'Drupal 11.4 ships vendor/bin/dr, an experimental core CLI',
                'slug'  => 'drupal-11-4-native-cli-dr',
                'content' => 'Drupal 11.4 (July 2026) introduces an experimental Symfony Console-based CLI at `vendor/bin/dr`, replacing the old hardcoded `core/scripts/drupal` entry point. It was built by a team that includes Drush maintainers — the stated plan is a gradual transition, not a hard cutover.' . "\n\n" .
'```bash' . "\n" .
'# Deprecated' . "\n" .
'php core/scripts/drupal generate-theme my_theme' . "\n\n" .
'# New' . "\n" .
'vendor/bin/dr generate-theme my_theme' . "\n" .
'```' . "\n\n" .
'Modules register commands by tagging a class in `src/Command` with Symfony\'s `#[AsCommand]` attribute — no `services.yml` wiring needed, unlike a classic Drush command. Still experimental, so I wouldn\'t migrate CI scripts to it yet, but it\'s worth writing new custom commands against it.',
                'tags'         => ['Drupal', 'CLI', 'Drush'],
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Drupal 11.4 locks down /search? query strings in robots.txt by default',
                'slug'  => 'drupal-11-4-robots-txt-search-query',
                'content' => 'Previously Drupal\'s default `robots.txt` only blocked path-based search URLs like `/search/keyword`. Query-parameter searches (`/search?q=keyword`) stayed crawlable, which let search engines index infinite combinations of faceted search pages.' . "\n\n" .
'```' . "\n" .
'Disallow: /search?' . "\n" .
'Disallow: /index.php/search?' . "\n" .
'```' . "\n\n" .
'Only new installs and sites still using the default scaffold `robots.txt` get this automatically — if you\'ve customized yours, Drupal won\'t touch it, and you have to add the rules by hand. If you\'re on Search API with facets instead of core search, double check your own query patterns are covered too; this change only targets core\'s `/search` path.',
                'tags'         => ['Drupal', 'SEO', 'Security'],
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Workspaces can\'t scope files — they land straight in live storage',
                'slug'  => 'drupal-workspaces-files-not-revisioned',
                'content' => 'File entities in Drupal aren\'t revisionable, so the Workspaces module has no mechanism to scope a file to a workspace the way it scopes a node. The moment a file is uploaded to `public://`, it\'s written to live storage in `sites/default/files` and served directly by the web server — no Drupal access check sits in that request path.' . "\n\n" .
'Practical effect: if an editor stages a node that references a brand-new image, the image itself is already publicly accessible at its live URL before the workspace is ever published. There is no "staged" version of a file. Keep that in mind for any workflow that assumes staged content is fully hidden until publish.',
                'tags'         => ['Drupal', 'Workspaces', 'Files'],
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'The Storybook addon for SDC skips the Drush-generated stories file entirely',
                'slug'  => 'drupal-sdc-storybook-addon-preview',
                'content' => 'The Drupal Storybook module needs Drush to generate `*.stories.twig` scaffolding for each component. The separate `storybook-addon-sdc` npm package skips that step — it reads a component\'s `.component.yml` and Twig template directly and builds the Storybook story dynamically.' . "\n\n" .
'```bash' . "\n" .
'npm install --save-dev storybook-addon-sdc' . "\n" .
'```' . "\n\n" .
'Useful when a frontend dev without a running Drupal/Drush environment needs to iterate on a component\'s markup and CSS in Storybook alone. For anything needing Drupal\'s own render pipeline (cache contexts, token replacement, access checks), fall back to the SDC Component Library module\'s `/components` route instead — that one runs inside Drupal, not beside it.',
                'tags'         => ['Drupal', 'SDC', 'Storybook'],
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($posts as $data) {
            TilPost::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
