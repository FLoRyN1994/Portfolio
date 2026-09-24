<x-layout>
<x-slot:title>Florin Tomozei — Software Engineer</x-slot:title>

<main class="pb-36">

    {{-- Hero --}}
    <section class="min-h-screen flex flex-col items-center justify-center px-6 text-center relative overflow-hidden">
        {{-- Animated orbs --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div data-orb class="orb absolute top-1/4 left-1/3 w-96 h-96 bg-blue-600" style="opacity:0.12;"></div>
            <div data-orb class="orb absolute bottom-1/4 right-1/3 w-72 h-72 bg-violet-600" style="opacity:0.08; animation-delay:2s;"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto space-y-6">
            <p class="text-blue-400 text-sm font-medium tracking-widest uppercase" data-hero>
                Available for work
            </p>
            <h1 class="text-5xl md:text-7xl font-semibold tracking-tight leading-tight text-gradient" data-hero>
                Florin Tomozei
            </h1>
            <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-xl mx-auto" data-hero>
                Software Engineer with ~10 years of experience.<br>
                Specializing in <span class="text-white font-medium">Drupal</span> &amp; <span class="text-white font-medium">Laravel</span>.
                Acquia certified.
            </p>
            <div class="flex items-center justify-center gap-4 pt-2" data-hero>
                <a href="/projects"
                   class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 hover:-translate-y-0.5">
                    View Projects
                </a>
                <a href="/contact"
                   class="px-6 py-3 glass glass-hover text-gray-300 rounded-xl font-medium">
                    Get in touch
                </a>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600" data-hero>
            <span class="text-xs tracking-widest uppercase">Scroll</span>
            <div class="bounce-slow w-px h-8 bg-gradient-to-b from-gray-600 to-transparent"></div>
        </div>
    </section>

    {{-- Stack --}}
    <section class="px-6 py-24 max-w-4xl mx-auto text-center">
        <p class="text-xs font-medium tracking-widest uppercase text-gray-600 mb-8" data-animate>Stack</p>
        <div class="flex flex-wrap justify-center gap-2" data-animate>
            @foreach(['PHP', 'Laravel', 'Drupal', 'MySQL', 'Livewire', 'Alpine.js', 'Tailwind CSS', 'GSAP', 'Filament', 'Git', 'Docker', 'Railway', 'Acquia Cloud'] as $tech)
            <span class="tag">{{ $tech }}</span>
            @endforeach
        </div>
    </section>

    {{-- Featured Projects --}}
    <section class="px-6 pb-12 max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-10" data-animate>
            <h2 class="text-2xl font-semibold">Featured Projects</h2>
            <a href="/projects" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">View all →</a>
        </div>

        @if($projects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($projects as $project)
            <a href="/projects/{{ $project->slug }}" class="glass glass-hover p-6 block group" data-animate>
                @if($project->thumbnail)
                <div class="overflow-hidden rounded-xl mb-5">
                    <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}"
                         class="w-full h-44 object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                </div>
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
        <div class="glass p-16 text-center text-gray-600 text-sm" data-animate>
            Projects coming soon.
        </div>
        @endif
    </section>

</main>

</x-layout>
