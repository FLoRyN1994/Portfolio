<x-layout>
<x-slot:title>Page Not Found — Florin Tomozei</x-slot:title>
<x-slot:description>This page does not exist.</x-slot:description>

<main class="min-h-[70vh] flex items-center justify-center px-6 pb-32 pt-20">
    <div class="max-w-xl mx-auto text-center">

        {{-- 404 number --}}
        <div class="relative inline-block mb-8">
            <span class="font-display text-[10rem] md:text-[12rem] font-bold leading-none text-transparent bg-clip-text"
                  style="background-image: linear-gradient(135deg, var(--color-accent) 0%, var(--color-warm) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                404
            </span>
            <div class="absolute inset-0 blur-3xl opacity-20"
                 style="background: linear-gradient(135deg, var(--color-accent), var(--color-warm)); border-radius: 9999px;"></div>
        </div>

        <h1 class="font-display text-3xl md:text-4xl text-text mb-4 tracking-tight">Page not found</h1>
        <p class="text-muted text-lg mb-10 leading-relaxed">
            The page you're looking for doesn't exist or has been moved.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/"
               class="px-6 py-3 rounded-full bg-accent text-white font-semibold text-sm hover:bg-accent/90 transition-colors">
                Back to home
            </a>
            <a href="/contact"
               class="px-6 py-3 rounded-full border border-line text-muted font-medium text-sm hover:text-text hover:border-accent/40 transition-colors">
                Contact me
            </a>
        </div>

        {{-- Decorative grid --}}
        <div class="mt-16 grid grid-cols-3 gap-3 max-w-xs mx-auto opacity-30">
            @foreach(['/','about','/projects','/blog','/til','/contact'] as $link)
            <a href="{{ $link }}"
               class="px-3 py-2 rounded-lg border border-line text-xs text-muted hover:text-accent hover:border-accent/30 transition-colors font-mono">
                {{ trim($link, '/') ?: 'home' }}
            </a>
            @endforeach
        </div>

    </div>
</main>

</x-layout>
