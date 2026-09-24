<x-layout>
<x-slot:title>Blog — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-3xl mx-auto">

        <div class="mb-16 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">Blog</h1>
            <p class="text-gray-400 text-lg">Thoughts on web development, PHP, and the craft of building software.</p>
        </div>

        @if($posts->count())
        <div class="space-y-4">
            @foreach($posts as $post)
            <a href="/blog/{{ $post->slug }}" class="glass glass-hover p-6 block group" data-animate>
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold mb-2 group-hover:text-blue-400 transition-colors">{{ $post->title }}</h2>
                        @if($post->excerpt)
                        <p class="text-gray-400 text-sm leading-relaxed mb-3">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-4">
                            @if($post->published_at)
                            <span class="text-xs text-gray-500">{{ $post->published_at->format('M j, Y') }}</span>
                            @endif
                            @if($post->tags)
                            <div class="flex gap-2">
                                @foreach(array_slice($post->tags, 0, 3) as $tag)
                                <span class="tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <span class="text-gray-600 group-hover:text-blue-400 transition-colors mt-1">→</span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="glass p-24 text-center text-gray-500" data-animate>
            Articles coming soon.
        </div>
        @endif

    </div>
</main>

</x-layout>
