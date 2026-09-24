<x-layout>
<x-slot:title>About — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-16 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">About Me</h1>
            <p class="text-gray-400 text-lg">Software Engineer · Drupal Expert · Laravel Specialist</p>
        </div>

        {{-- Bio --}}
        <div class="glass p-8 mb-8" data-animate>
            <p class="text-gray-300 leading-relaxed text-lg mb-4">
                I'm a Software Engineer with around 10 years of experience delivering projects across multiple sectors.
                My primary focus is backend web development, specialising in <strong class="text-white">Drupal</strong> and <strong class="text-white">Laravel</strong>.
            </p>
            <p class="text-gray-400 leading-relaxed">
                I'm an <strong class="text-white">Acquia Certified Drupal Developer</strong>, which reflects my deep expertise in the Drupal ecosystem —
                from custom module development and site building to performance optimisation and migrations.
                On the Laravel side, I build modern, clean applications with a focus on maintainability and developer experience.
            </p>
        </div>

        {{-- Bento Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <div class="glass p-6 col-span-2 md:col-span-1" data-animate>
                <div class="text-3xl font-bold text-blue-400 mb-1">~10</div>
                <div class="text-gray-400 text-sm">Years of experience</div>
            </div>
            <div class="glass p-6" data-animate>
                <div class="text-3xl font-bold text-blue-400 mb-1">30+</div>
                <div class="text-gray-400 text-sm">Projects delivered</div>
            </div>
            <div class="glass p-6" data-animate>
                <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center mb-3">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <div class="text-sm font-medium text-white">Acquia Certified</div>
                <div class="text-gray-400 text-xs mt-1">Drupal Developer</div>
            </div>
            <div class="glass p-6 col-span-2" data-animate>
                <div class="text-sm text-gray-500 uppercase tracking-widest mb-3">Location</div>
                <div class="text-white font-medium">Iași, Romania 🇷🇴</div>
                <div class="text-gray-400 text-sm mt-1">Available for remote work worldwide</div>
            </div>
        </div>

        {{-- Skills --}}
        <div class="glass p-8 mb-8" data-animate>
            <h2 class="text-xl font-semibold mb-6">Skills</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm text-gray-500 uppercase tracking-widest mb-3">Backend</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['PHP', 'Laravel', 'Drupal', 'MySQL', 'REST APIs', 'GraphQL'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 uppercase tracking-widest mb-3">Frontend</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Tailwind CSS', 'Alpine.js', 'Livewire', 'GSAP', 'JavaScript'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 uppercase tracking-widest mb-3">DevOps</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Git', 'Docker', 'Railway', 'GitHub Actions', 'Acquia Cloud'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="glass p-8" data-animate>
            <h2 class="text-xl font-semibold mb-6">Timeline</h2>
            <div class="space-y-6">
                @foreach([
                    ['2024 — Present', 'Senior Software Engineer', 'Working on enterprise Drupal & Laravel projects'],
                    ['2020 — 2024', 'Software Engineer', 'Full-stack development, Drupal migrations, Laravel APIs'],
                    ['2016 — 2020', 'Web Developer', 'Drupal site building, custom module development'],
                    ['2016', 'Acquia Certified', 'Achieved Acquia Certified Drupal Developer certification'],
                ] as $item)
                <div class="flex gap-4">
                    <div class="text-xs text-gray-500 font-mono mt-1 w-36 shrink-0">{{ $item[0] }}</div>
                    <div class="flex-1 pb-6 border-b border-white/5 last:border-0">
                        <div class="font-medium text-white mb-1">{{ $item[1] }}</div>
                        <div class="text-gray-400 text-sm">{{ $item[2] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</main>

</x-layout>
