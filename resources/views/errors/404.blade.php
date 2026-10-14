<x-layout>
<x-slot:title>Page Not Found — Florin Tomozei</x-slot:title>
<x-slot:description>This page does not exist.</x-slot:description>

<main class="flex-1 flex items-center justify-center px-6 py-20">
    <div class="max-w-lg mx-auto text-center">

        {{-- Glow behind 404 --}}
        <div class="relative inline-block mb-6">
            {{-- Blur blobs --}}
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-32 rounded-full blur-[72px] opacity-30 pointer-events-none"
                 style="background: linear-gradient(135deg, #4f8cff 0%, #f3b664 100%);"></div>

            {{-- 404 text --}}
            <p class="relative font-display font-bold leading-none tracking-tighter select-none text-text"
               style="font-size: clamp(6.5rem, 22vw, 11rem);">
                404
            </p>
        </div>

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-4">Page not found</p>

        <h1 class="font-display text-3xl md:text-4xl text-text tracking-tight leading-tight mb-4">
            Nothing here.
        </h1>

        <p class="text-muted leading-relaxed mb-10 max-w-xs mx-auto">
            The page you're looking for doesn't exist or has been moved.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3 rounded-full bg-accent text-white text-sm font-semibold hover:bg-accent/90 active:scale-95 transition-all duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Back to home
            </a>
            <a href="/contact"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3 rounded-full border border-line bg-surface text-muted text-sm font-medium hover:text-text hover:border-accent/30 hover:bg-surface-2 active:scale-95 transition-all duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Contact me
            </a>
        </div>

    </div>
</main>

</x-layout>
