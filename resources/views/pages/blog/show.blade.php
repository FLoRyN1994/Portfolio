<x-layout>
<x-slot:title>{{ $post->title }} — Florin Tomozei</x-slot:title>
<x-slot:description>{{ $post->excerpt ?? 'An article by Florin Tomozei on Drupal, PHP, and web development.' }}</x-slot:description>

{{-- Reading progress bar --}}
<div id="read-progress" aria-hidden="true"></div>

<main class="pb-32 pt-20 px-6">
    <div class="max-w-2xl mx-auto">

        {{-- Back --}}
        <a href="/blog" class="inline-flex items-center gap-2 font-mono text-xs text-muted hover:text-accent transition-colors mb-14 group" data-reveal>
            <svg class="w-3 h-3 transition-transform duration-150 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            All posts
        </a>

        <article id="article">

            {{-- Header --}}
            <header class="mb-14" data-reveal>

                @if($post->cover_image)
                <div class="aspect-video overflow-hidden rounded-2xl mb-12 border border-line">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->cover_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover"
                         loading="eager">
                </div>
                @endif

                {{-- Tags + date + reading time --}}
                @php
                    $wordCount = str_word_count(strip_tags($post->content ?? ''));
                    $readingTime = max(1, (int) ceil($wordCount / 230));
                @endphp
                <div class="flex flex-wrap items-center gap-2.5 mb-7">
                    @if($post->tags)
                    @foreach($post->tags as $tag)
                    <span class="font-mono text-[0.7rem] px-2.5 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent tracking-wide">{{ $tag }}</span>
                    @endforeach
                    @endif
                    <span class="w-px h-3.5 bg-line self-center mx-1"></span>
                    @if($post->published_at)
                    <span class="font-mono text-xs text-muted/60">{{ $post->published_at->format('M j, Y') }}</span>
                    @endif
                    <span class="font-mono text-xs text-muted/40">· {{ $readingTime }} min read</span>
                </div>

                {{-- Title --}}
                <h1 class="font-display text-[2.4rem] md:text-5xl text-text leading-[1.1] tracking-tight mb-7">{{ $post->title }}</h1>

                {{-- Excerpt --}}
                @if($post->excerpt)
                <div class="flex gap-4">
                    <div class="w-0.5 shrink-0 rounded-full bg-gradient-to-b from-accent to-accent/0 mt-1"></div>
                    <p class="text-muted text-lg leading-relaxed">{{ $post->excerpt }}</p>
                </div>
                @endif

            </header>

            {{-- Divider --}}
            <div class="flex items-center gap-4 mb-14" data-reveal>
                <div class="h-px flex-1 bg-line"></div>
                <span class="font-mono text-[0.6rem] text-muted/30 tracking-[0.3em] uppercase">Article</span>
                <div class="h-px flex-1 bg-line"></div>
            </div>

            {{-- Body --}}
            <div class="blog-content" data-reveal>
                {!! $post->content !!}
            </div>

            {{-- Footer --}}
            <footer class="mt-20">
                <div class="h-px bg-gradient-to-r from-transparent via-line to-transparent mb-10"></div>
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <a href="/blog" class="inline-flex items-center gap-2 text-sm text-muted hover:text-accent transition-colors group">
                        <svg class="w-3.5 h-3.5 transition-transform duration-150 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        Back to blog
                    </a>
                    <a href="/til" class="font-mono text-xs text-muted/50 hover:text-accent transition-colors">
                        Short notes →
                    </a>
                </div>
            </footer>

        </article>
    </div>
</main>

<script>
    (function () {
        const bar = document.getElementById('read-progress');
        const article = document.getElementById('article');
        if (!bar || !article) return;
        function update() {
            const rect = article.getBoundingClientRect();
            const total = article.offsetHeight - window.innerHeight;
            const scrolled = Math.max(0, -rect.top);
            bar.style.width = Math.min(100, total > 0 ? (scrolled / total) * 100 : 0) + '%';
        }
        window.addEventListener('scroll', update, { passive: true });
        update();
    })();
</script>

</x-layout>
