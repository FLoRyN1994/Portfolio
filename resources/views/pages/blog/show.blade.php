<x-layout>
<x-slot:title>{{ $post->title }} — Florin Tomozei</x-slot:title>
<x-slot:description>{{ $post->excerpt ?? 'An article by Florin Tomozei on Drupal, PHP, and web development.' }}</x-slot:description>

<main class="pb-32 pt-20 px-6">
    <div class="max-w-3xl mx-auto">

        <a href="/blog" class="inline-flex items-center gap-2 font-mono text-xs text-muted hover:text-accent transition-colors mb-12" data-reveal>
            ← All posts
        </a>

        <article>
            <header class="mb-12" data-reveal>
                @if($post->cover_image)
                <div class="aspect-video overflow-hidden rounded-2xl mb-10 border border-line">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->cover_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover"
                         loading="eager">
                </div>
                @endif

                <div class="flex flex-wrap items-center gap-3 mb-5">
                    @if($post->tags)
                    @foreach($post->tags as $tag)
                    <span class="font-mono text-xs px-2.5 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent">{{ $tag }}</span>
                    @endforeach
                    @endif
                    @if($post->published_at)
                    <span class="font-mono text-xs text-muted">{{ $post->published_at->format('F j, Y') }}</span>
                    @endif
                </div>

                <h1 class="font-display text-4xl md:text-5xl text-text leading-tight mb-5">{{ $post->title }}</h1>

                @if($post->excerpt)
                <p class="text-muted text-lg leading-relaxed border-l-2 border-accent/40 pl-5">{{ $post->excerpt }}</p>
                @endif
            </header>

            <div class="prose prose-lg max-w-none
                        prose-headings:font-display prose-headings:text-text
                        prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-4
                        prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                        prose-p:text-muted prose-p:leading-relaxed prose-p:my-4
                        prose-a:text-accent prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-text
                        prose-em:text-warm
                        prose-blockquote:border-l-2 prose-blockquote:border-accent/40 prose-blockquote:text-muted prose-blockquote:not-italic prose-blockquote:pl-5
                        prose-code:text-accent prose-code:before:content-none prose-code:after:content-none prose-code:bg-surface-2 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm
                        prose-pre:bg-surface prose-pre:border prose-pre:border-line prose-pre:rounded-2xl prose-pre:my-6
                        prose-ul:text-muted prose-ol:text-muted
                        prose-li:my-1
                        prose-hr:border-line prose-hr:my-10
                        prose-img:rounded-2xl prose-img:border prose-img:border-line" data-reveal>
                {!! $post->content !!}
            </div>

            <footer class="mt-16 pt-8 border-t border-line flex items-center justify-between gap-4 flex-wrap">
                <a href="/blog" class="inline-flex items-center gap-2 text-sm text-muted hover:text-accent transition-colors">
                    ← Back to blog
                </a>
                <a href="/contact" class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-surface border border-line text-sm text-muted hover:border-accent/30 hover:text-accent transition-all duration-200">
                    Get in touch →
                </a>
            </footer>
        </article>

    </div>
</main>

</x-layout>
