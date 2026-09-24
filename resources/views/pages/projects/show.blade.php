<x-layout>
<x-slot:title>{{ $project->title }} — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-3xl mx-auto">

        <a href="/projects" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-white transition-colors mb-10" data-animate>
            ← Back to projects
        </a>

        <div data-animate>
            @if($project->thumbnail)
            <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-64 object-cover rounded-2xl mb-8 opacity-90">
            @endif

            <h1 class="text-4xl font-semibold tracking-tight mb-4">{{ $project->title }}</h1>
            <p class="text-gray-400 text-lg mb-6">{{ $project->summary }}</p>

            <div class="flex flex-wrap gap-3 mb-8">
                @if($project->url)
                <a href="{{ $project->url }}" target="_blank" rel="noopener" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-sm font-medium transition-colors">
                    View Live ↗
                </a>
                @endif
                @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="px-4 py-2 glass glass-hover text-gray-300 rounded-xl text-sm font-medium transition-colors">
                    GitHub ↗
                </a>
                @endif
            </div>

            @if($project->tech_stack)
            <div class="flex flex-wrap gap-2 mb-10">
                @foreach($project->tech_stack as $tech)
                <span class="tag">{{ $tech }}</span>
                @endforeach
            </div>
            @endif
        </div>

        @if($project->content)
        <div class="glass p-8 prose prose-invert prose-blue max-w-none" data-animate>
            {!! $project->content !!}
        </div>
        @endif

    </div>
</main>

</x-layout>
