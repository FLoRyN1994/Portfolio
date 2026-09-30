<x-layout>
<x-slot:title>{{ $project->title }} — Florin Tomozei</x-slot:title>
<x-slot:description>{{ $project->summary }}</x-slot:description>

<main class="py-20 px-6 min-h-screen">
    <div class="max-w-4xl mx-auto">

        {{-- Back --}}
        <a href="/projects"
           class="inline-flex items-center gap-2 text-sm text-muted hover:text-text transition-colors mb-14 group outline-none focus-visible:text-text"
           data-reveal>
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            All projects
        </a>

        {{-- Header --}}
        <div class="mb-12" data-reveal data-reveal-delay="0.05">
            <x-section-label>{{ $project->role }}</x-section-label>
            <h1 class="font-display text-5xl md:text-6xl text-text mt-3 mb-5 leading-tight">{{ $project->title }}</h1>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-muted">
                @if($project->agency)
                <span class="flex items-center gap-1.5">
                    via
                    <a href="{{ $project->agency->url }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="text-text hover:text-accent transition-colors">
                        {{ $project->agency->name }}
                    </a>
                </span>
                @endif

                @if($project->url)
                <a href="{{ $project->url }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 hover:text-accent transition-colors">
                    <span>Visit site</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                @endif
            </div>
        </div>

        {{-- Screenshot --}}
        @if($project->thumbnail)
        <div class="mb-12 rounded-2xl overflow-hidden border border-line" data-reveal data-reveal-delay="0.1">
            <div class="flex items-center gap-1.5 px-3 py-2 bg-surface-2 border-b border-line">
                <span class="w-2 h-2 rounded-full bg-red-500/40" aria-hidden="true"></span>
                <span class="w-2 h-2 rounded-full bg-yellow-400/40" aria-hidden="true"></span>
                <span class="w-2 h-2 rounded-full bg-green-500/40" aria-hidden="true"></span>
                <span class="flex-1 mx-2 font-mono text-xs text-muted bg-surface rounded px-2 py-0.5 truncate">
                    {{ parse_url($project->url, PHP_URL_HOST) }}
                </span>
            </div>
            <img src="{{ $project->thumbnail }}"
                 alt="{{ $project->title }} — website screenshot"
                 class="w-full object-cover max-h-[480px]"
                 loading="lazy">
        </div>
        @else
        {{-- Ambient header image when no screenshot --}}
        <div class="mb-12 rounded-2xl overflow-hidden border border-line aspect-video bg-surface-2 relative" data-reveal data-reveal-delay="0.1">
            <div class="absolute inset-0 bg-gradient-to-br from-accent/8 to-warm/5 flex items-center justify-center">
                <span class="font-mono text-sm text-muted/50">{{ parse_url($project->url, PHP_URL_HOST) }}</span>
            </div>
        </div>
        @endif

        {{-- Tech stack --}}
        @if($project->tech_stack)
        <div class="flex flex-wrap gap-2 mb-12" data-reveal data-reveal-delay="0.12">
            @foreach($project->tech_stack as $tech)
            <x-chip>{{ $tech }}</x-chip>
            @endforeach
        </div>
        @endif

        {{-- Summary card --}}
        <div class="p-6 bg-surface border border-line rounded-2xl mb-12" data-reveal data-reveal-delay="0.14">
            <x-section-label class="mb-3">Overview</x-section-label>
            <p class="text-muted leading-relaxed">{{ $project->summary }}</p>
        </div>

        {{-- Case study content --}}
        @if($project->content)
        <div class="prose-dark prose prose-lg max-w-none" data-reveal data-reveal-delay="0.16">
            {!! str($project->content)->markdown() !!}
        </div>
        @endif

    </div>
</main>

</x-layout>
