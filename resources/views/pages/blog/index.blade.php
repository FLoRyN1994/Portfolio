<x-layout>
<x-slot:title>Blog — Florin Tomozei</x-slot:title>
<x-slot:description>Long-form articles on Drupal, PHP, and web development — from architecture decisions to debugging deep dives.</x-slot:description>

<main class="pb-32 pt-20 px-6">
    <div class="max-w-3xl mx-auto">

        <div class="mb-16" data-reveal>
            <x-section-label>Long-form writing</x-section-label>
            <h1 class="font-display text-5xl md:text-6xl text-text mt-3 leading-tight">Blog</h1>
            <p class="text-muted mt-4 text-lg max-w-xl leading-relaxed">
                Thoughts on Drupal, PHP architecture, AI tooling, and the craft of building software.
            </p>
        </div>

        @if($posts->count())
        <div class="space-y-3">
            @foreach($posts as $post)
            <a href="/blog/{{ $post->slug }}"
               class="group flex items-start gap-5 p-6 rounded-2xl border border-line bg-surface hover:-translate-y-0.5 hover:border-accent/20 hover:shadow-xl hover:shadow-bg/50 transition-all duration-200 block"
               data-reveal data-reveal-delay="{{ $loop->index * 0.05 }}">

                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        @if($post->tags)
                        @foreach(array_slice((array) $post->tags, 0, 3) as $tag)
                        <span class="font-mono text-[0.65rem] px-2 py-0.5 rounded-md bg-surface-2 border border-line text-muted/70">{{ $tag }}</span>
                        @endforeach
                        @endif
                        @if($post->published_at)
                        <span class="font-mono text-xs text-muted/40 ml-auto flex-none">{{ $post->published_at->format('M j, Y') }}</span>
                        @endif
                    </div>
                    <h2 class="text-text font-semibold text-lg leading-snug mb-2 group-hover:text-accent transition-colors duration-150">{{ $post->title }}</h2>
                    @if($post->excerpt)
                    <p class="text-muted text-sm leading-relaxed line-clamp-2">{{ $post->excerpt }}</p>
                    @endif
                </div>

                <span class="flex-none text-muted/30 group-hover:text-accent transition-colors duration-150 mt-1 text-lg">→</span>
            </a>
            @endforeach
        </div>
        @else
        <div class="border border-line rounded-3xl p-24 text-center text-muted" data-reveal>
            Articles coming soon.
        </div>
        @endif

    </div>
</main>

</x-layout>
