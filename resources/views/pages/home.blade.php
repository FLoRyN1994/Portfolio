<x-layout>
<x-slot:title>Florin Tomozei — Software Engineer</x-slot:title>

<main class="pb-32">

    {{-- Hero --}}
    <section class="min-h-screen flex flex-col items-center justify-center px-6 text-center relative overflow-hidden">
        {{-- Background glow --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <p class="text-blue-400 text-sm font-medium tracking-widest uppercase mb-4" data-animate>
                Available for work
            </p>
            <h1 class="text-5xl md:text-7xl font-semibold tracking-tight mb-6 text-gradient" data-animate>
                Florin Tomozei
            </h1>
            <p class="text-xl text-gray-400 mb-8 leading-relaxed" data-animate>
                Software Engineer with ~10 years of experience.<br>
                Specializing in <span class="text-white">Drupal</span> &amp; <span class="text-white">Laravel</span>.
                Acquia certified.
            </p>
            <div class="flex items-center justify-center gap-4" data-animate>
                <a href="/projects" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition-colors">
                    View Projects
                </a>
                <a href="/contact" class="px-6 py-3 glass glass-hover text-gray-300 rounded-xl font-medium transition-colors">
                    Get in touch
                </a>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600" data-animate>
            <span class="text-xs tracking-widest uppercase">Scroll</span>
            <div class="w-px h-8 bg-gradient-to-b from-gray-600 to-transparent"></div>
        </div>
    </section>

    {{-- Stack --}}
    <section class="px-6 py-24 max-w-5xl mx-auto">
        <h2 class="text-sm font-medium tracking-widest uppercase text-gray-500 mb-12 text-center" data-animate>
            Tech Stack
        </h2>
        <div class="flex flex-wrap justify-center gap-3" data-animate>
            @foreach(['PHP', 'Laravel', 'Drupal', 'MySQL', 'Livewire', 'Alpine.js', 'Tailwind CSS', 'GSAP', 'Filament', 'Git', 'Docker', 'Railway'] as $tech)
            <span class="tag">{{ $tech }}</span>
            @endforeach
        </div>
    </section>

    {{-- Featured Projects --}}
    <section class="px-6 py-12 max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-10" data-animate>
            <h2 class="text-2xl font-semibold">Featured Projects</h2>
            <a href="/projects" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">View all →</a>
        </div>

        @if($projects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
            <a href="/projects/{{ $project->slug }}" class="glass glass-hover p-6 block group" data-animate>
                @if($project->thumbnail)
                <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-40 object-cover rounded-lg mb-4 opacity-80 group-hover:opacity-100 transition-opacity">
                @endif
                <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $project->summary }}</p>
                @if($project->tech_stack)
                <div class="flex flex-wrap gap-2">
                    @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                    <span class="tag">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
            </a>
            @endforeach
        </div>
        @else
        <div class="glass p-12 text-center text-gray-500" data-animate>
            Projects coming soon.
        </div>
        @endif
    </section>

</main>

</x-layout>
