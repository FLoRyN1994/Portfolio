<x-layout>
<x-slot:title>Projects — Florin Tomozei</x-slot:title>
<x-slot:description>A selection of client platforms and digital products I've contributed to as a full-stack Drupal developer.</x-slot:description>

<main class="py-20 px-6 min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-16" data-reveal>
            <x-section-label>Portfolio</x-section-label>
            <h1 class="font-display text-5xl md:text-6xl text-text mt-3 leading-tight">Client platforms</h1>
            <p class="text-muted mt-4 text-lg max-w-xl leading-relaxed">
                A selection of digital platforms I've contributed to as a full-stack developer, working with agencies and their clients.
            </p>
        </div>

        @if($projects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
            <div class="relative group bg-surface border border-line rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-accent/20 hover:shadow-2xl hover:shadow-bg/50"
                 data-reveal data-reveal-delay="{{ $loop->index * 0.07 }}">

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
                            <h2 class="text-text font-semibold text-lg leading-snug">{{ $project->title }}</h2>
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

                {{-- Full-card link --}}
                <a href="/projects/{{ $project->slug }}"
                   class="absolute inset-0 z-0 rounded-3xl outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                   aria-label="View {{ $project->title }} case study"></a>
            </div>
            @endforeach
        </div>
        @else
        <div class="py-32 text-center" data-reveal>
            <p class="text-muted text-sm font-mono">No projects published yet.</p>
        </div>
        @endif

    </div>
</main>

</x-layout>
