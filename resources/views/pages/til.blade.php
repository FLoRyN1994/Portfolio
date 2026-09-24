<x-layout>
<x-slot:title>TIL — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-3xl mx-auto">

        <div class="mb-16 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">TIL</h1>
            <p class="text-gray-400 text-lg">Today I Learned — short notes on things I discover.</p>
        </div>

        @if($posts->count())
        <div class="space-y-4">
            @foreach($posts as $post)
            <div class="glass glass-hover p-6" data-animate>
                <div class="flex items-start justify-between gap-4 mb-3">
                    <h2 class="text-base font-semibold">{{ $post->title }}</h2>
                    @if($post->published_at)
                    <span class="text-xs text-gray-500 shrink-0">{{ $post->published_at->format('M j, Y') }}</span>
                    @endif
                </div>
                <div class="text-gray-400 text-sm leading-relaxed prose prose-invert prose-sm max-w-none">
                    {!! $post->content !!}
                </div>
                @if($post->tags)
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($post->tags as $tag)
                    <span class="tag">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="glass p-24 text-center text-gray-500" data-animate>
            TIL posts coming soon.
        </div>
        @endif

    </div>
</main>

</x-layout>
