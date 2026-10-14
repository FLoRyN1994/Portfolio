<x-layout>
<x-slot:title>TIL — Florin Tomozei</x-slot:title>
<x-slot:description>Short, practical things I learn day-to-day as a Drupal and PHP developer — snippets, gotchas, and useful patterns.</x-slot:description>

<main class="pb-32 pt-20 px-6">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-16" data-reveal>
            <x-section-label>Short-form notes</x-section-label>
            <h1 class="font-display text-5xl md:text-6xl text-text mt-3 leading-tight">Today I Learned</h1>
            <p class="text-muted mt-4 text-lg max-w-xl leading-relaxed">
                Things I run into as a Drupal &amp; PHP developer — snippets, gotchas, and patterns worth writing down.
            </p>

            {{-- Tag filter --}}
            @php
                $allTags = $posts->flatMap(fn($p) => $p->tags ?? [])->unique()->sort()->values();
            @endphp
            @if($allTags->count())
            <div x-data="{ active: '' }" class="flex flex-wrap gap-2 mt-8">
                <button @click="active = ''"
                        :class="active === '' ? 'border-accent/50 text-accent bg-accent/5' : 'border-line text-muted hover:border-accent/30 hover:text-text'"
                        class="font-mono text-xs px-3 py-1.5 rounded-full border transition-all duration-150">
                    All
                </button>
                @foreach($allTags as $tag)
                <button @click="active = active === '{{ $tag }}' ? '' : '{{ $tag }}'"
                        :class="active === '{{ $tag }}' ? 'border-accent/50 text-accent bg-accent/5' : 'border-line text-muted hover:border-accent/30 hover:text-text'"
                        class="font-mono text-xs px-3 py-1.5 rounded-full border transition-all duration-150">
                    {{ $tag }}
                </button>
                @endforeach

                {{-- Entry count --}}
                <span class="ml-auto self-center font-mono text-xs text-muted/40">
                    {{ $posts->count() }} entries
                </span>
            </div>
            @endif
        </div>

        {{-- Entries --}}
        @if($posts->count())
        <div x-data="{ active: '' }" class="space-y-1">
            @foreach($posts as $post)
            @php $tagsJson = json_encode($post->tags ?? []); @endphp
            <article
                id="{{ $post->slug }}"
                x-show="active === '' || {{ $tagsJson }}.some(t => t === active)"
                x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }"
                x-transition:enter="transition duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="border border-line rounded-2xl overflow-hidden bg-surface transition-colors duration-200 hover:border-accent/20"
                data-reveal data-reveal-delay="{{ $loop->index * 0.05 }}">

                {{-- Accordion header --}}
                <button
                    @click="open = !open"
                    class="w-full flex items-start gap-4 p-5 text-left group">

                    {{-- Toggle icon --}}
                    <span class="mt-0.5 flex-none w-5 h-5 rounded-full border border-line flex items-center justify-center transition-colors duration-200 group-hover:border-accent/40"
                          :class="open ? 'bg-accent/10 border-accent/40' : ''">
                        <svg class="w-2.5 h-2.5 text-muted transition-transform duration-300"
                             :class="open ? 'rotate-180 text-accent' : ''"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-1.5 flex-wrap">
                            @if($post->tags)
                            @foreach($post->tags as $tag)
                            <span class="font-mono text-[0.65rem] px-2 py-0.5 rounded-md bg-surface-2 border border-line text-muted/70 leading-none">{{ $tag }}</span>
                            @endforeach
                            @endif
                            @if($post->published_at)
                            <span class="ml-auto font-mono text-xs text-muted/40 flex-none">{{ $post->published_at->format('M j, Y') }}</span>
                            @endif
                        </div>
                        <h2 class="text-text font-semibold text-base leading-snug group-hover:text-accent transition-colors duration-150">
                            {{ $post->title }}
                        </h2>
                    </div>
                </button>

                {{-- Accordion body --}}
                <div x-show="open"
                     x-collapse
                     class="border-t border-line/60">
                    <div class="p-5 pt-4 prose prose-sm prose-dark max-w-none
                                prose-p:text-muted prose-p:leading-relaxed
                                prose-code:before:content-none prose-code:after:content-none
                                prose-pre:my-4 prose-pre:rounded-xl
                                prose-li:text-muted">
                        {!! Str::markdown($post->content) !!}
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        @else
        <div class="border border-line rounded-3xl p-24 text-center text-muted" data-reveal>
            No entries yet — check back soon.
        </div>
        @endif

    </div>
</main>

</x-layout>
