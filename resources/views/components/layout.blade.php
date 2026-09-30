<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Florin Tomozei — Drupal Developer' }}</title>
    <meta name="description" content="{{ $description ?? 'Drupal developer for ambitious digital platforms, with the PHP range to solve the harder problems around them.' }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @fonts
    {{-- Fraunces italic variant (bunny plugin bundles normal only) --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=fraunces:ital,wght@1,400;1,500&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" x-data>

    @php
        $currentPath = '/' . request()->path();
        $isHome      = $currentPath === '/';
        $bookHref    = config('portfolio.calendly_url') ?: '/contact';
        $bookExternal = (bool) config('portfolio.calendly_url');

        $navLinks = [
            ['id' => 'hero',    'label' => 'Home',    'href' => '/',                              'route' => '/'],
            ['id' => 'work',    'label' => 'Work',    'href' => $isHome ? '#work'    : '/#work'],
            ['id' => 'skills',  'label' => 'Skills',  'href' => $isHome ? '#skills'  : '/#skills'],
            ['id' => 'journey', 'label' => 'Journey', 'href' => $isHome ? '#journey' : '/#journey'],
            ['id' => 'notes',   'label' => 'Notes',   'href' => $isHome ? '#notes'   : '/#notes'],
            ['id' => 'contact', 'label' => 'Contact', 'href' => '/contact',                        'route' => '/contact'],
        ];
    @endphp

    {{-- Floating pill navigation --}}
    <nav
        x-data="pillNav({{ $isHome ? 'true' : 'false' }})"
        x-init="init()"
        class="fixed top-4 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none"
        aria-label="Main navigation">

        {{-- Pill --}}
        <div class="pointer-events-auto relative flex items-center gap-px px-1.5 py-1.5 rounded-full border border-line/50 bg-bg/88 backdrop-blur-xl shadow-xl">

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-px">
                @foreach($navLinks as $link)
                    @php $isActiveRoute = isset($link['route']) && $currentPath === $link['route']; @endphp
                    <a
                        href="{{ $link['href'] }}"
                        data-nav-section="{{ $link['id'] }}"
                        class="px-3 py-1.5 rounded-full text-sm font-medium transition-colors duration-200 outline-none focus-visible:ring-2 focus-visible:ring-accent/60
                            {{ !$isHome && $isActiveRoute ? 'text-text bg-surface-2' : 'text-muted hover:text-text' }}"
                        :class="{{ $isHome ? "activeSection === '{$link['id']}' ? 'text-text bg-surface-2' : ''" : "''" }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Divider (desktop only) --}}
            <div class="hidden md:block w-px h-4 bg-line mx-1" aria-hidden="true"></div>

            {{-- Book a call --}}
            <a
                href="{{ $bookHref }}"
                class="px-4 py-1.5 rounded-full text-sm font-semibold bg-accent text-white hover:bg-accent/90 transition-colors duration-200 outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                @if($bookExternal) target="_blank" rel="noopener noreferrer" @endif>
                Book a call
            </a>

            {{-- Mobile hamburger --}}
            <button
                class="md:hidden ml-1 p-2 rounded-full text-muted hover:text-text transition-colors outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen.toString()"
                aria-controls="mobile-nav"
                aria-label="Toggle navigation menu">
                <svg x-show="!mobileOpen" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile dropdown --}}
        <div
            id="mobile-nav"
            x-show="mobileOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
            @click.outside="mobileOpen = false"
            @keydown.escape.window="mobileOpen = false"
            class="pointer-events-auto absolute top-[calc(100%+0.5rem)] left-1/2 -translate-x-1/2 w-52 rounded-2xl border border-line bg-surface/95 backdrop-blur-xl shadow-2xl overflow-hidden"
            role="menu"
            aria-label="Mobile navigation">
            <ul class="py-2">
                @foreach($navLinks as $link)
                <li role="none">
                    <a
                        href="{{ $link['href'] }}"
                        @click="mobileOpen = false"
                        class="block px-4 py-2.5 text-sm font-medium text-muted hover:text-text hover:bg-surface-2 transition-colors"
                        role="menuitem">
                        {{ $link['label'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>

    {{-- Page content (offset for fixed nav) --}}
    <div class="pt-16">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    <footer class="border-t border-line mt-24 py-12 px-6">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-6 text-sm text-muted">
            <p class="font-mono text-xs tracking-wide">© {{ date('Y') }} Florin Tomozei</p>
            <nav class="flex items-center gap-6" aria-label="Footer navigation">
                <a href="/about"   class="hover:text-text transition-colors">About</a>
                <a href="/blog"    class="hover:text-text transition-colors">Blog</a>
                <a href="/til"     class="hover:text-text transition-colors">TIL</a>
                <a href="/contact" class="hover:text-text transition-colors">Contact</a>
            </nav>
        </div>
    </footer>

</body>
</html>
