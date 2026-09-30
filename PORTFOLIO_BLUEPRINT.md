# Portfolio: Blueprint and Claude Implementation Prompts

Owner: Florin Tomozei. Existing stack: Laravel 13, Filament 3 (`/admin`), Livewire 3, Alpine.js, Tailwind, GSAP, MySQL/SQLite, Railway.

## 1. Goal

A live presentation of Florin: Drupal developer with wide PHP range, warm and technical in tone. It should feel like a guided presentation, with real motion and a premium dark look. Audience: freelance clients and agencies. No personal photo for now.

**Positioning line:** "Drupal developer for ambitious digital platforms, with the PHP range to solve the harder problems around them."

## 2. Visual direction ("midnight studio")

| Token | Value |
|---|---|
| Background | `#0a0c13` |
| Surface / Surface 2 | `#11141f` / `#171b29` |
| Line | `#232838` |
| Text / Muted | `#ece9e1` / `#9aa1b5` |
| Accent (blue) | `#4f8cff` |
| Warm accent (amber) | `#f3b664` |
| Display font | Fraunces (400/500, italic for one emphasized word) |
| Body font | Hanken Grotesk |
| Mono font | JetBrains Mono (labels, code, metadata) |

Rules: thin technical lines, a faint blueprint grid in the hero, glass only where it adds depth, big typography, rounded 24px cards. Motion reveals structure and is never decorative. Full `prefers-reduced-motion` support.

## 3. Page blueprint (home)

1. **Nav**: floating dock-style pill (Home, Work, Skills, Journey, Notes, Contact) plus a "Book a call" button.
2. **Hero**: the positioning line as H1 (one word in amber italic), a short sub-line, two CTAs ("See selected work", "Schedule a meeting"), and a "stack" card with terminal styling.
3. **Proof strip**: 9+ years, Acquia certified, 5 agencies, 4 client platforms.
4. **Agency ribbon**: REEA, Eton Digital, Holycode, Softehnica, Infynit Digital (logos, each linked, slow marquee that pauses on hover).
5. **Client platforms**: Ecolint (ecolint.ch), Swatch Group (swatchgroup.com), Blancpain (blancpain.com), Flowit (flowit.ai). Each card has a screenshot, the exact role (full-stack developer), the agency it came through, the stack, and a link. Never claim "my project".
6. **Skills bento**: CMS/Drupal, Backend PHP (Symfony, Laravel), Frontend (JS, jQuery, Twig, SCSS, HTML5), Delivery (Agile, Jira, Asana).
7. **Journey**: horizontal, scroll-linked timeline of the agencies.
8. **Notes**: one featured article plus TIL rows (already exist as Blog and TIL).
9. **Contact**: contact form, LinkedIn, Calendly link.

Other routes stay as in CLAUDE.md: `/about`, `/projects`, `/projects/{slug}`, `/blog`, `/til`, `/contact`, `/admin`.

## 4. Things Florin must supply (never invent these)

- Which agency delivered each end-client platform, plus a one-line contribution per site.
- Confirmation that each agency and end-client may be named and shown with a logo.
- Timeline: years and roles per agency.
- LinkedIn URL, Calendly URL, contact email.
- Optional: CV.

## 5. Project facts from the audit (already reflected in the prompts below)

- Tailwind v4, CSS-first: tokens go in `@theme` in `resources/css/app.css`. There is no `tailwind.config.js`.
- Fonts come from the Vite `bunny()` plugin in `vite.config.js` (currently Instrument Sans) and the `@fonts` directive in `resources/views/components/layout.blade.php`.
- The current nav is a bottom macOS-style dock in that layout, with a `dock()` Alpine helper in `resources/js/app.js`.
- No app-level Livewire components exist. Use plain Blade forms.
- Routes are closures in `routes/web.php`. `POST /contact` validates but has a `// TODO: send mail`.
- The `projects` table has: title, slug, summary, content, url, github_url, thumbnail, tech_stack, featured, sort_order. There is no role or agency yet.
- `main` auto-deploys to Railway. Work on the branch `redesign/midnight-studio`.
- `Dockerfile` and `.claude/settings.local.json` had uncommitted edits before this work. Do not include them in redesign commits.

**To stop the permission prompts in PhpStorm:** in the Claude Code plugin choose the "accept edits" mode, and add allow rules for `npm`, `php artisan`, `composer`, `git status/diff/add/commit` and `vendor/bin/phpunit` in `.claude/settings.local.json`. Do not allow `git push`.

## 6. Implementation prompts (send one at a time, review the diff between each)

### Prompt 0: audit only

```
Read CLAUDE.md, AGENTS.md, routes/, app/Models, app/Filament/Resources, app/Http/Livewire, resources/views, resources/css/app.css, resources/js/app.js, package.json and tailwind config.
Do NOT change any files. Do NOT read .env or any secrets.
First run `git checkout -b redesign/midnight-studio` (never work on main; main auto-deploys). Do not stage Dockerfile or .claude/settings.local.json.
Return: (1) what currently exists per page, (2) what is reusable, (3) risks, (4) a short plan for redesigning the site as a "midnight studio" presentation portfolio (dark, warm + technical, GSAP scroll motion, Filament-managed content). Keep it under 60 lines.
```

### Prompt 1: design system and layout shell

```
Implement the visual foundation only. Do not build page content yet.
- Tailwind v4 tokens in the `@theme` block of resources/css/app.css (no tailwind.config.js): bg #0a0c13, surface #11141f, surface2 #171b29, line #232838, text #ece9e1, muted #9aa1b5, accent #4f8cff, warm #f3b664.
- Fonts via the existing `bunny()` plugin in vite.config.js (replace Instrument Sans): Fraunces (display), Hanken Grotesk (body), JetBrains Mono (mono). Map to --font-display / --font-sans / --font-mono.
- Rework resources/views/components/layout.blade.php: replace the bottom dock with a floating top pill nav (Home, Work, Skills, Journey, Notes, Contact + "Book a call"), sticky, active-section highlight on the home page and active route elsewhere, mobile menu, keyboard accessible, plus a footer. Remove the unused dock() helper only if nothing else uses it.
- Reusable Blade components: section-label (mono, letter-spaced, amber), card, button-primary, button-ghost, chip.
- Faint 64px blueprint grid + soft radial glows for hero background as a reusable component.
- Global motion helpers in resources/js/app.js (GSAP + ScrollTrigger): a `data-reveal` attribute that fades/slides elements in, fully disabled when prefers-reduced-motion is set.
Keep existing routes working. Show me the diff summary when done. Do not touch .env.
```

### Prompt 2: home hero, proof strip, agency ribbon

```
Rebuild the home page top section using the foundation from the last step.
1) Hero: H1 "Drupal developer for ambitious digital platforms." with the word "ambitious" in italic warm accent. Sub-line: "Acquia-certified, full-stack, and comfortable with the harder PHP problems around a CMS. I work with agencies and their clients to ship calm, polished systems." CTAs: "See selected work" (scrolls to #work) and "Schedule a meeting" (CALENDLY_URL from config). Right side: a terminal-style "stack" card listing role, cms, backend, frontend, delivery. Subtle SplitText or line reveal on the H1.
2) Proof strip: "9+ years", "Acquia certified", "5 agencies", "4 platforms". Counters may animate once when in view.
3) Agency ribbon: REEA, Eton Digital, Holycode, Softehnica, Infynit Digital, each a link to its public site. Use text wordmarks for now; leave an `logo_path` field so approved logos can be swapped in. Slow marquee, pause on hover, static when reduced motion.
Put the agency list in a Filament-managed model (name, url, logo, sort order) with a seeder for these five. Do not invent facts or statistics.
```

### Prompt 3: client platforms (Work)

```
Build the "Client platforms" section and case-study page using the existing Project model/Filament resource (extend it, do not duplicate).
Fields: client name, url, screenshot, role (default "Full-stack developer"), agency (relation to the agency model), stack (tags), one-line summary, optional long case study, published flag, sort order.
Add a migration for the new columns (role, agency_id nullable, published) on the existing `projects` table; keep existing columns and the `featured` scope working.
Seed four entries: Ecolint (ecolint.ch), Swatch Group (swatchgroup.com), Blancpain (blancpain.com), Flowit (flowit.ai). Summary for each: "Full-stack development on the public <Client> website, delivered with an agency partner." Leave agency and tech_stack empty and hide those UI parts when empty. Do NOT seed literal "[TO CONFIRM]" text, because it would show publicly. Never state outcomes or metrics.
UI: 2x2 grid of cards (browser-frame screenshot, name, role line, "via <agency>", stack chips, "Visit site"). Hover: card lifts, screenshot pans slowly. /projects/{slug}: story layout (context, my role, what I built, stack) with animated transitions. Only render published entries.
```

### Prompt 4: skills bento and journey

```
1) Skills bento grid (4 columns): Drupal end to end (large, accent border), Backend PHP (Symfony, Laravel), Frontend (JavaScript, jQuery, Twig, SCSS/CSS, HTML5), Delivery (Agile, Jira, Asana), and a warm-accent "What agencies get" card. Content from a Filament-editable model or config, not hard-coded in Blade. Cards reveal with a stagger.
2) Journey: horizontal timeline, one node per agency (REEA, Eton Digital, Holycode, Softehnica, Infynit Digital). Scroll-linked with GSAP ScrollTrigger (pinned or scrubbed), vertical stack on mobile. Years and descriptions come from a Filament model. Seed only the agency names in the order given, with empty period/description hidden in the UI, and do not label the order as chronological until Florin supplies dates.
```

### Prompt 5: notes and contact

```
1) Notes section on the home page: one featured Post (flag on the Post model) plus the latest three TIL posts as rows. Link to /blog and /til.
2) Contact section: replace the closure POST /contact in routes/web.php (currently `// TODO: send mail`) with a controller and a plain Blade form (name, email, message), with server-side validation, honeypot, rate limiting (throttle middleware), CSRF, success/error states, and a mail notification to CONTACT_EMAIL from config. Store submissions in a table viewable in Filament. Add "Schedule a meeting" (CALENDLY_URL) and "Connect on LinkedIn" (LINKEDIN_URL) buttons. Read all three from config/env with .env.example entries only. Do not read or print real secrets.
Add feature tests for the form (valid, invalid, throttled, honeypot).
```

### Prompt 6: motion, responsive, accessibility, SEO

```
Polish pass:
- Responsive from 360px up; check every section.
- prefers-reduced-motion disables all GSAP animation and marquees.
- Accessibility: landmarks, focus states, contrast >= 4.5:1, real buttons/links, alt text, labelled form fields.
- Performance: lazy-load images, preload fonts, no layout shift, Lighthouse target 90+ on all four categories.
- SEO: title/description per page, Open Graph image, sitemap, JSON-LD Person.
- Run the test suite and fix failures. Summarize anything left undone.
```

## 7. Working rules for every prompt

- One slice at a time, review the diff, then commit to a branch (never straight to `main`, which auto-deploys to Railway).
- Never read or print `.env`, tokens or real client data.
- Unknown facts (agency per site, timeline years, contributions) stay empty and hidden in the UI until Florin supplies them. Never invent them.
