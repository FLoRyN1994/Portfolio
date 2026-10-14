<x-layout>
<x-slot:title>Page Not Found — Florin Tomozei</x-slot:title>
<x-slot:description>This page does not exist.</x-slot:description>

<main class="min-h-[80vh] flex items-center justify-center px-6">
    <div class="max-w-lg mx-auto text-center">

        {{-- 404 --}}
        <div class="relative inline-block mb-6">
            <span class="font-display font-bold leading-none select-none"
                  style="font-size: clamp(7rem, 20vw, 13rem); background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-warm) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                404
            </span>
            <div class="absolute inset-0 -z-10 blur-[80px] opacity-25 rounded-full"
                 style="background: linear-gradient(135deg, var(--color-accent), var(--color-warm));"></div>
        </div>

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-5">Page not found</p>

        <h1 class="font-display text-3xl md:text-4xl text-text tracking-tight mb-5 leading-tight">
            This page doesn't exist.
        </h1>

        <p class="text-muted text-lg leading-relaxed mb-12 max-w-sm mx-auto">
            It may have been moved, deleted, or you may have mistyped the URL.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/"
               class="px-7 py-3 rounded-full bg-accent text-white font-semibold text-sm hover:bg-accent/90 transition-colors duration-200">
                Back to home
            </a>
            <a href="/contact"
               class="px-7 py-3 rounded-full border border-line text-muted font-medium text-sm hover:text-text hover:border-accent/40 transition-colors duration-200">
                Contact me
            </a>
        </div>

    </div>
</main>

</x-layout>
