<x-layout>
<x-slot:title>Projects — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-5xl mx-auto">

        <div class="mb-16 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">Projects</h1>
            <p class="text-gray-400 text-lg">A selection of things I've built.</p>
        </div>

        @if($projects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
            <a href="/projects/{{ $project->slug }}" class="glass glass-hover p-6 block group" data-animate>
                @if($project->thumbnail)
                <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-44 object-cover rounded-lg mb-5 opacity-80 group-hover:opacity-100 transition-opacity">
                @else
                <div class="w-full h-44 rounded-lg mb-5 bg-white/5 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                @endif
                <div class="flex items-start justify-between gap-4 mb-2">
                    <h2 class="text-lg font-semibold group-hover:text-blue-400 transition-colors">{{ $project->title }}</h2>
                    <div class="flex gap-2 shrink-0">
                        @if($project->github_url)
                        <span class="text-gray-500 hover:text-white text-xs transition-colors">GitHub ↗</span>
                        @endif
                        @if($project->url)
                        <span class="text-gray-500 hover:text-white text-xs transition-colors">Live ↗</span>
                        @endif
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $project->summary }}</p>
                @if($project->tech_stack)
                <div class="flex flex-wrap gap-2">
                    @foreach(array_slice($project->tech_stack, 0, 5) as $tech)
                    <span class="tag">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
            </a>
            @endforeach
        </div>
        @else
        <div class="glass p-24 text-center text-gray-500" data-animate>
            Projects coming soon.
        </div>
        @endif

    </div>
</main>

</x-layout>
