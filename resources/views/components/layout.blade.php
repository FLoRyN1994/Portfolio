<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Florin Tomozei — Software Engineer' }}</title>
    <meta name="description" content="{{ $description ?? 'Software Engineer with ~10 years of experience in Drupal and Laravel.' }}">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative" x-data>

    <div class="relative z-10">
        {{ $slot }}
    </div>

    {{-- macOS Dock Navigation --}}
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50"
         x-data="dock()"
         @mousemove="handleMouseMove($event)"
         @mouseleave="reset()">

        <div class="flex items-end gap-1 px-4 py-3 glass rounded-2xl shadow-2xl">
            @php
                $currentPath = request()->path();
                $navItems = [
                    ['/', 'Home', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['/about', 'About', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ['/projects', 'Projects', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                    ['/blog', 'Blog', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['/til', 'TIL', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                    ['/contact', 'Contact', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $href = $item[0];
                    $label = $item[1];
                    $path = $item[2];
                    $isActive = ($href === '/' && $currentPath === '/')
                        || ($href !== '/' && str_starts_with('/' . $currentPath, $href));
                @endphp
                <a href="{{ $href }}"
                   class="dock-item group relative flex flex-col items-center px-1">
                    <div class="dock-icon w-11 h-11 flex items-center justify-center rounded-xl transition-colors duration-200 origin-bottom
                        {{ $isActive ? 'bg-blue-500/20 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/8' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
                        </svg>
                    </div>
                    {{-- Tooltip --}}
                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 px-2 py-1 text-xs glass rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap pointer-events-none text-white">
                        {{ $label }}
                    </span>
                    {{-- Active dot --}}
                    @if($isActive)
                    <span class="absolute -bottom-0.5 w-1 h-1 rounded-full bg-blue-400"></span>
                    @endif
                </a>
            @endforeach
        </div>
    </nav>

</body>
</html>
