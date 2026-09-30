<x-layout>
<x-slot:title>Florin Tomozei — Drupal Developer</x-slot:title>
<x-slot:description>Drupal developer for ambitious digital platforms, with the PHP range to solve the harder problems around them. Acquia-certified, full-stack, based in Romania.</x-slot:description>

{{-- ═══════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════ --}}
<section id="hero" data-section="hero"
    class="relative min-h-[calc(100vh-4rem)] flex items-center px-6 py-20 overflow-hidden">

    <x-hero-bg />

    <div class="relative z-10 w-full max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- Headline column --}}
            <div class="lg:col-span-7 space-y-8">

                <div data-hero>
                    <x-section-label>Available for new projects</x-section-label>
                </div>

                <h1 class="font-display text-[2.75rem] md:text-6xl lg:text-[4.25rem] leading-[1.06] text-text" data-hero>
                    Drupal developer<br>
                    for <em class="text-warm">ambitious</em><br>
                    digital platforms.
                </h1>

                <p class="text-muted text-lg leading-relaxed max-w-lg" data-hero>
                    Acquia-certified, full-stack, and comfortable with the harder PHP
                    problems around a CMS. I work with agencies and their clients to
                    ship calm, polished systems.
                </p>

                @php $meetingHref = config('portfolio.calendly_url') ?: '/contact'; @endphp
                <div class="flex flex-wrap items-center gap-4" data-hero>
                    <x-button-primary href="#work">See selected work</x-button-primary>
                    @if(config('portfolio.calendly_url'))
                        <x-button-ghost href="{{ $meetingHref }}" target="_blank" rel="noopener noreferrer">Schedule a meeting</x-button-ghost>
                    @else
                        <x-button-ghost href="{{ $meetingHref }}">Schedule a meeting</x-button-ghost>
                    @endif
                </div>
            </div>

            {{-- Terminal card --}}
            <div class="lg:col-span-5" data-hero>
                <div class="bg-surface-2 border border-line rounded-2xl overflow-hidden shadow-xl shadow-bg/50">
                    {{-- Title bar --}}
                    <div class="flex items-center gap-1.5 px-4 py-3 border-b border-line bg-surface">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500/50"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-400/50"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500/50"></span>
                        <span class="ml-2 font-mono text-xs text-muted tracking-wide">stack.sh</span>
                    </div>

                    {{-- Body --}}
                    <div class="p-5 font-mono text-sm space-y-3.5">
                        @foreach([
                            ['key' => 'role',     'val' => 'Full-stack developer',     'accent' => false],
                            ['key' => 'cms',      'val' => 'Drupal · Acquia Cloud',    'accent' => true],
                            ['key' => 'backend',  'val' => 'PHP · Symfony · Laravel',  'accent' => false],
                            ['key' => 'frontend', 'val' => 'JS · Twig · SCSS',         'accent' => false],
                            ['key' => 'delivery', 'val' => 'Agile · Jira · Asana',     'accent' => false],
                        ] as $line)
                        <div class="flex gap-3 items-baseline">
                            <span class="text-accent/60 select-none flex-none">→</span>
                            <div>
                                <span class="text-muted">{{ $line['key'] }}</span>
                                <span class="{{ $line['accent'] ? 'text-accent' : 'text-text' }} ml-2">{{ $line['val'] }}</span>
                            </div>
                        </div>
                        @endforeach

                        {{-- Blinking cursor --}}
                        <div class="flex gap-3 items-center pt-1">
                            <span class="text-accent/60 select-none">→</span>
                            <span class="inline-block w-2 h-[1.1em] bg-accent/70 animate-pulse"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll nudge --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-muted/50" data-hero>
        <span class="font-mono text-[0.65rem] tracking-[0.2em] uppercase">scroll</span>
        <div class="bounce-slow w-px h-8 bg-gradient-to-b from-muted/40 to-transparent"></div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     PROOF STRIP
═══════════════════════════════════════════════════════ --}}
<section class="border-y border-line/50 py-16">
    <div class="max-w-5xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4">

            {{-- 9+ years --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal>
                <span class="font-display text-5xl font-medium text-text leading-none">9<span class="text-accent">+</span></span>
                <span class="text-muted text-sm">years of experience</span>
            </div>

            {{-- Acquia certified --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.08">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-warm/10 border border-warm/25 text-warm text-sm font-medium">
                    <svg class="w-3.5 h-3.5 flex-none" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                    </svg>
                    Certified
                </span>
                <span class="text-muted text-sm">Acquia certified</span>
            </div>

            {{-- 5 agencies --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.16">
                <span class="font-display text-5xl font-medium text-text leading-none">5</span>
                <span class="text-muted text-sm">agencies worked with</span>
            </div>

            {{-- 4 platforms --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.24">
                <span class="font-display text-5xl font-medium text-text leading-none">4</span>
                <span class="text-muted text-sm">client platforms</span>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     AGENCY RIBBON
═══════════════════════════════════════════════════════ --}}
@if($agencies->count())
<section class="py-16">
    <div class="max-w-5xl mx-auto px-6 mb-10 text-center" data-reveal>
        <x-section-label>Agencies I've worked with</x-section-label>
    </div>

    {{-- Marquee --}}
    <div class="relative overflow-hidden marquee-container" role="marquee" aria-label="Agency list">
        {{-- Fade edges --}}
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-bg to-transparent z-10 pointer-events-none" aria-hidden="true"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-bg to-transparent z-10 pointer-events-none" aria-hidden="true"></div>

        <div class="flex items-center gap-6 animate-marquee w-max">
            {{-- First copy --}}
            @foreach($agencies as $agency)
            <a
                href="{{ $agency->url }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-none flex items-center gap-3 px-5 py-2.5 rounded-xl border border-line bg-surface text-muted hover:text-text hover:border-accent/30 hover:bg-surface-2 font-medium text-sm transition-all duration-200 whitespace-nowrap">
                @if($agency->logo_path)
                    <img src="{{ Storage::url($agency->logo_path) }}" alt="{{ $agency->name }} logo" class="h-5 w-auto opacity-70">
                @endif
                {{ $agency->name }}
            </a>
            @endforeach
            {{-- Duplicate for seamless loop --}}
            @foreach($agencies as $agency)
            <a
                href="{{ $agency->url }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-hidden="true"
                tabindex="-1"
                class="flex-none flex items-center gap-3 px-5 py-2.5 rounded-xl border border-line bg-surface text-muted hover:text-text hover:border-accent/30 hover:bg-surface-2 font-medium text-sm transition-all duration-200 whitespace-nowrap">
                @if($agency->logo_path)
                    <img src="{{ Storage::url($agency->logo_path) }}" alt="" class="h-5 w-auto opacity-70">
                @endif
                {{ $agency->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     WORK — Client platforms
═══════════════════════════════════════════════════════ --}}
<section id="work" data-section="work" class="py-24 px-6">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-end justify-between mb-14" data-reveal>
            <div>
                <x-section-label>Selected work</x-section-label>
                <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Client platforms</h2>
            </div>
            <a href="/projects" class="text-sm text-muted hover:text-text transition-colors hidden sm:block">
                All projects →
            </a>
        </div>

        @if($platforms->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($platforms as $project)
            <div class="relative group bg-surface border border-line rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-accent/20 hover:shadow-2xl hover:shadow-bg/50"
                 data-reveal data-reveal-delay="{{ $loop->index * 0.08 }}">

                {{-- Browser frame --}}
                <x-browser-frame url="{{ $project->url }}">
                    @if($project->thumbnail)
                    <img
                        src="{{ $project->thumbnail }}"
                        alt="{{ $project->title }} website"
                        class="w-full h-full object-cover object-top transition-transform duration-700 ease-out group-hover:scale-105 group-hover:-translate-y-2"
                        loading="lazy">
                    @else
                    <div class="absolute inset-0 flex items-center justify-center select-none">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent/8 to-warm/5"></div>
                        <span class="relative font-mono text-xs text-muted/50">{{ parse_url($project->url, PHP_URL_HOST) }}</span>
                    </div>
                    @endif
                </x-browser-frame>

                {{-- Card body --}}
                <div class="p-6">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div>
                            <h3 class="text-text font-semibold text-lg leading-snug">{{ $project->title }}</h3>
                            <p class="text-muted text-sm mt-0.5">{{ $project->role }}</p>
                        </div>
                        @if($project->url)
                        <a href="{{ $project->url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-none font-mono text-xs text-muted hover:text-accent transition-colors mt-0.5 z-10 relative"
                           aria-label="Visit {{ $project->title }} website">
                            Visit site ↗
                        </a>
                        @endif
                    </div>

                    @if($project->agency)
                    <p class="font-mono text-xs text-muted mb-3">via {{ $project->agency->name }}</p>
                    @endif

                    <p class="text-muted text-sm leading-relaxed mb-4">{{ $project->summary }}</p>

                    @if($project->tech_stack)
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice((array) $project->tech_stack, 0, 5) as $tech)
                        <x-chip>{{ $tech }}</x-chip>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Full-card link (behind the "Visit site" button) --}}
                <a href="/projects/{{ $project->slug }}"
                   class="absolute inset-0 z-0 rounded-3xl outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                   aria-label="View {{ $project->title }} case study"></a>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- Placeholder anchors for future sections (Prompts 4–5) --}}
<div id="skills"></div>
<div id="journey"></div>
<div id="notes"></div>

</x-layout>
