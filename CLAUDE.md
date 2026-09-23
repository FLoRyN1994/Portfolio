# Portfolio — Florin Tomozei

Personal portfolio website for Florin Tomozei, a software engineer with ~10 years of experience specializing in Drupal (Acquia certified) and Laravel.

## Stack

- **Framework**: Laravel 13
- **Admin panel**: Filament 3 (at `/admin`)
- **Frontend**: Livewire 3 + Alpine.js + Tailwind CSS
- **Animations**: GSAP (ScrollTrigger, SplitText)
- **Database**: MySQL (production) / SQLite (local dev)
- **Hosting**: Railway
- **CI/CD**: GitHub Actions → Railway (`.github/workflows/deploy.yml`)

## Local Development

```bash
php artisan serve        # start dev server
npm run dev              # Vite asset watcher
php artisan migrate      # run migrations
```

## Project Structure

```
app/
  Filament/Resources/   # admin panel resources (Projects, Posts, TIL)
  Http/Livewire/        # Livewire components
  Models/               # Project, Post, TilPost, etc.
resources/
  views/
    pages/              # Home, About, Projects, Blog, TIL, Contact
    components/         # reusable Blade components
    livewire/           # Livewire views
  css/app.css           # Tailwind + custom styles
  js/app.js             # Alpine.js + GSAP init
```

## Pages

| Route | Description |
|---|---|
| `/` | Hero, intro, stack, featured projects |
| `/about` | Bio, timeline, Acquia cert, skills bento grid |
| `/projects` | Portfolio grid |
| `/projects/{slug}` | Case study detail |
| `/blog` | Long-form articles |
| `/til` | Today I Learned snippets |
| `/contact` | Contact form |
| `/admin` | Filament admin panel |

## Design

- Dark theme (`#0a0a0f` background)
- Glassmorphism cards (`backdrop-blur` + `rgba` backgrounds)
- Bento grid layout for skills/about sections
- GSAP scroll-triggered animations
- macOS dock-style navigation
- Color accent: electric blue `#3b82f6`

## CI/CD

Push to `main` → GitHub Actions runs tests → deploys to Railway.
Set `RAILWAY_TOKEN` secret in GitHub repo settings.

## GitHub

Repository: https://github.com/FLoRyN1994/Portfolio
