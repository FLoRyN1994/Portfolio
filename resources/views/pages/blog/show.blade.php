<x-layout>
<x-slot:title>{{ $post->title }} — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-3xl mx-auto">

        <a href="/blog" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-white transition-colors mb-10" data-animate>
            ← Back to blog
        </a>

        <article>
            <header class="mb-10" data-animate>
                @if($post->cover_image)
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="w-full h-56 object-cover rounded-2xl mb-8 opacity-90">
                @endif
                <h1 class="text-4xl font-semibold tracking-tight mb-4">{{ $post->title }}</h1>
                <div class="flex items-center gap-4">
                    @if($post->published_at)
                    <span class="text-sm text-gray-500">{{ $post->published_at->format('F j, Y') }}</span>
                    @endif
                    @if($post->tags)
                    <div class="flex gap-2">
                        @foreach($post->tags as $tag)
                        <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </header>

            <div class="glass p-8 prose prose-invert prose-blue max-w-none" data-animate>
                {!! $post->content !!}
            </div>
        </article>

    </div>
</main>

</x-layout>
