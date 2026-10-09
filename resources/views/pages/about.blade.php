<x-layout>
<x-slot:title>About — Florin Tomozei</x-slot:title>
<x-slot:description>PHP/Drupal developer with 9 years of experience building large-scale CMS platforms for agencies. Acquia Certified, Symfony-proficient, open to remote work.</x-slot:description>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-16 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">About Me</h1>
            <p class="text-gray-400 text-lg">PHP / Drupal Developer · Acquia Certified · Open to remote</p>
        </div>

        {{-- Bio --}}
        <div class="glass p-8 mb-8" data-animate>
            <p class="text-gray-300 leading-relaxed text-lg mb-4">
                I'm a PHP/Drupal developer with 9 years of experience delivering projects across multiple sectors
                and agency environments. My core focus is <strong class="text-white">large-scale Drupal platforms</strong> —
                custom module development, Symfony-based architecture, performance optimisation, migrations,
                and enterprise-grade integrations.
            </p>
            <p class="text-gray-400 leading-relaxed">
                I hold the <strong class="text-white">Acquia Certified Developer — Drupal 10</strong> certification,
                reflecting deep expertise across the full Drupal ecosystem. Beyond CMS work, I build clean
                Laravel applications and have hands-on experience with React, TypeScript, Docker, and AWS.
                I work well in Agile teams, value code reviews, and care about maintainability as much as
                shipping features.
            </p>
        </div>

        {{-- Stats grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="glass p-6 text-center" data-animate>
                <div class="text-3xl font-bold text-blue-400 mb-1">9</div>
                <div class="text-gray-400 text-sm">Years experience</div>
            </div>
            <div class="glass p-6 text-center" data-animate>
                <div class="text-3xl font-bold text-blue-400 mb-1">30+</div>
                <div class="text-gray-400 text-sm">Projects delivered</div>
            </div>
            <div class="glass p-6 text-center" data-animate>
                <div class="text-sm font-semibold text-white mb-1">Acquia Certified</div>
                <div class="text-gray-400 text-xs">Drupal 10 Developer</div>
            </div>
            <div class="glass p-6 text-center" data-animate>
                <div class="text-sm font-semibold text-white mb-1">Bacau, Romania 🇷🇴</div>
                <div class="text-gray-400 text-xs">Remote worldwide</div>
            </div>
        </div>

        {{-- Work experience --}}
        <div class="glass p-8 mb-8" data-animate>
            <h2 class="text-xl font-semibold mb-8">Work Experience</h2>

            <div class="space-y-10">

                {{-- Holycode --}}
                <div class="relative pl-6 border-l border-white/10">
                    <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-blue-400/80 border-2 border-bg"></div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2 mb-1">
                        <h3 class="font-semibold text-white">PHP / Drupal Developer</h3>
                        <span class="font-mono text-xs text-gray-500">Mar 2024 – Dec 2025</span>
                    </div>
                    <p class="text-blue-400/80 text-sm mb-3">Holycode · Remote, Romania</p>
                    <ul class="text-gray-400 text-sm space-y-1.5 list-none">
                        <li>→ Maintained and evolved a large-scale Drupal 8–10 platform, improving stability, reliability, and performance.</li>
                        <li>→ Refactored legacy code, enhancing maintainability and reducing technical debt.</li>
                        <li>→ Developed custom Drupal modules tailored to complex business requirements.</li>
                        <li>→ Implemented third-party integrations including SSO with 360Learning as an Identity Provider.</li>
                        <li>→ Analysed architectures and data flows, proposing and implementing enterprise-level solutions.</li>
                        <li>→ Collaborated in Agile processes with product owners, QA, and stakeholders.</li>
                    </ul>
                </div>

                {{-- REEA --}}
                <div class="relative pl-6 border-l border-white/10">
                    <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-blue-400/80 border-2 border-bg"></div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2 mb-1">
                        <h3 class="font-semibold text-white">Drupal Developer</h3>
                        <span class="font-mono text-xs text-gray-500">Sep 2018 – Present</span>
                    </div>
                    <p class="text-blue-400/80 text-sm mb-3">REEA · Iași, Romania / Remote</p>
                    <ul class="text-gray-400 text-sm space-y-1.5">
                        <li>→ Built and maintained large-scale Drupal 8–10 applications using Symfony-based architecture and MVC principles.</li>
                        <li>→ Designed and implemented custom modules, business logic, and scalable architectures.</li>
                        <li>→ Built and integrated RESTful APIs, consuming and exposing third-party services.</li>
                        <li>→ Worked with Linux environments, Apache/Nginx, Docker, and deployment pipelines.</li>
                        <li>→ Participated in technical planning, system architecture decisions, and code reviews.</li>
                        <li>→ Agile experience: Scrum/Kanban, sprint planning, daily stand-ups, and retrospectives.</li>
                    </ul>
                </div>

                {{-- Softescu --}}
                <div class="relative pl-6 border-l border-white/10">
                    <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-blue-400/80 border-2 border-bg"></div>
                    <div class="flex flex-wrap items-baseline justify-between gap-2 mb-1">
                        <h3 class="font-semibold text-white">PHP / Drupal Developer</h3>
                        <span class="font-mono text-xs text-gray-500">Feb 2017 – Aug 2018</span>
                    </div>
                    <p class="text-blue-400/80 text-sm mb-3">Softescu · Bacau, Romania</p>
                    <ul class="text-gray-400 text-sm space-y-1.5">
                        <li>→ Built and maintained Drupal 7–8 projects, focusing on custom module and theme development.</li>
                        <li>→ Implemented backend features with PHP/SQL and responsive front-end components using CSS/JavaScript.</li>
                    </ul>
                </div>

            </div>
        </div>

        {{-- Education & Certification --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

            <div class="glass p-8" data-animate>
                <h2 class="text-xl font-semibold mb-6">Education</h2>
                <div class="space-y-6">
                    <div>
                        <p class="font-mono text-xs text-gray-500 mb-1">Oct 2016 – Jul 2018</p>
                        <p class="font-semibold text-white text-sm">M.S. Computer Science</p>
                        <p class="text-gray-400 text-sm">University "Vasile Alecsandri", Bacau</p>
                    </div>
                    <div>
                        <p class="font-mono text-xs text-gray-500 mb-1">Oct 2013 – Jul 2016</p>
                        <p class="font-semibold text-white text-sm">B.S. Computer Science</p>
                        <p class="text-gray-400 text-sm">University "Vasile Alecsandri", Bacau</p>
                    </div>
                </div>
            </div>

            <div class="glass p-8" data-animate>
                <h2 class="text-xl font-semibold mb-6">Certification</h2>
                <div class="flex items-start gap-4">
                    <img src="{{ asset('badge.png') }}" alt="Acquia Certified Drupal 10 Developer badge" class="w-16 h-16 object-contain shrink-0">
                    <div>
                        <p class="font-semibold text-white text-sm leading-snug">Acquia Certified Developer</p>
                        <p class="text-blue-400 text-sm">Drupal 10</p>
                        <p class="text-gray-500 text-xs mt-2">Issued by Acquia — validates expertise in Drupal architecture, module development, and site configuration.</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Skills --}}
        <div class="glass p-8" data-animate>
            <h2 class="text-xl font-semibold mb-6">Skills</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-3">CMS / Backend</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Drupal 8/9/10', 'PHP 8+', 'Symfony', 'Laravel', 'MySQL', 'PostgreSQL', 'REST API', 'OOP', 'Design Patterns', 'TDD'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-3">Frontend</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['React', 'TypeScript', 'JavaScript', 'jQuery', 'Twig', 'HTML', 'CSS', 'SASS'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-3">DevOps</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Docker', 'AWS', 'Acquia Cloud', 'Apache', 'Linux', 'Git', 'GitHub Actions', 'CI/CD'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-3">Tools</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Postman', 'Jira', 'Firebase', 'Google Services', 'FFMPEG', 'Drupal Migration'] as $skill)
                        <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

</x-layout>
