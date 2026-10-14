<x-layout>
<x-slot:title>Page Not Found — Florin Tomozei</x-slot:title>
<x-slot:description>This page does not exist.</x-slot:description>

@php $badPath = '/' . request()->path(); @endphp

<main class="flex-1 flex items-center justify-center px-4 py-20">
    <div class="w-full max-w-2xl mx-auto">

        {{-- Label --}}
        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-6 text-center">404 — Page not found</p>

        {{-- IDE Window --}}
        <div class="rounded-xl border border-line bg-surface overflow-hidden shadow-2xl">

            {{-- Window chrome --}}
            <div class="flex items-center gap-2 px-4 py-3 bg-surface-2 border-b border-line">
                <span class="w-3 h-3 rounded-full bg-red-500/70"></span>
                <span class="w-3 h-3 rounded-full bg-yellow-400/70"></span>
                <span class="w-3 h-3 rounded-full bg-green-500/70"></span>
                <span class="ml-3 font-mono text-xs text-muted/60">router.ts — tofdev.com</span>
            </div>

            {{-- Code --}}
            <div class="px-0 py-4 font-mono text-[0.78rem] leading-6 overflow-x-auto">
                @php
                $lines = [
                    [1, '<span style="color:#9aa1b5">import</span> <span style="color:#ece9e1">{ Router }</span> <span style="color:#9aa1b5">from</span> <span style="color:#a5d6a7">\'@tofdev/router\'</span><span style="color:#ece9e1">;</span>'],
                    [2, ''],
                    [3, '<span style="color:#9aa1b5">async function</span> <span style="color:#f3b664">handleRequest</span><span style="color:#ece9e1">(</span><span style="color:#4f8cff">url</span><span style="color:#ece9e1">: </span><span style="color:#9aa1b5">string</span><span style="color:#ece9e1">) {</span>'],
                    [4, '&nbsp;&nbsp;<span style="color:#9aa1b5">const</span> <span style="color:#ece9e1">page</span> <span style="color:#9aa1b5">=</span> <span style="color:#9aa1b5">await</span> <span style="color:#ece9e1">router</span><span style="color:#9aa1b5">.</span><span style="color:#f3b664">resolve</span><span style="color:#ece9e1">(url);</span>'],
                    [5, ''],
                    [6, '&nbsp;&nbsp;<span style="color:#9aa1b5">if</span> <span style="color:#ece9e1">(!</span><span style="color:#ece9e1">page) {</span>'],
                    [7, null], // error line
                    [8, '&nbsp;&nbsp;}<span style="color:#ece9e1"></span>'],
                    [9, ''],
                    [10, '&nbsp;&nbsp;<span style="color:#9aa1b5">return</span> <span style="color:#ece9e1">page</span><span style="color:#9aa1b5">.</span><span style="color:#f3b664">render</span><span style="color:#ece9e1">();</span>'],
                    [11, '<span style="color:#ece9e1">}</span>'],
                ];
                @endphp

                @foreach($lines as [$num, $code])
                @if($num === 7)
                {{-- Error line --}}
                <div class="flex items-start bg-red-500/10 border-l-2 border-red-500">
                    <span class="select-none w-10 shrink-0 text-right pr-4 text-muted/25 text-[0.72rem] leading-6">{{ $num }}</span>
                    <span class="pr-6 text-red-300">&nbsp;&nbsp;<span style="color:#9aa1b5">throw new</span> <span style="color:#f3b664">HttpError</span>(<span style="color:#f3b664">404</span>, <span style="color:#a5d6a7">'{{ $badPath }}'</span>);</span>
                </div>
                {{-- Squiggle + inline error --}}
                <div class="flex items-start bg-red-500/5">
                    <span class="select-none w-10 shrink-0"></span>
                    <span class="pr-6 text-red-400/80 text-[0.7rem] leading-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~~ <span style="color:#f87171">Cannot resolve path <strong>'{{ $badPath }}'</strong> · HTTP 404</span></span>
                </div>
                @else
                <div class="flex items-start hover:bg-white/[0.02] transition-colors">
                    <span class="select-none w-10 shrink-0 text-right pr-4 text-muted/25 text-[0.72rem] leading-6">{{ $num }}</span>
                    <span class="pr-6">{!! $code !!}</span>
                </div>
                @endif
                @endforeach
            </div>

            {{-- Problems panel --}}
            <div class="border-t border-line bg-surface-2">
                <div class="flex items-center gap-4 px-4 pt-2 border-b border-line/50">
                    <span class="font-mono text-xs text-red-400 pb-2 border-b-2 border-red-400">● PROBLEMS <span class="ml-1 px-1.5 py-0.5 rounded bg-red-500/20 text-red-300 text-[10px]">1</span></span>
                    <span class="font-mono text-xs text-muted/40 pb-2">OUTPUT</span>
                    <span class="font-mono text-xs text-muted/40 pb-2">TERMINAL</span>
                </div>
                <div class="flex items-start gap-3 px-4 py-3">
                    <svg class="w-3.5 h-3.5 text-red-400 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <div>
                        <p class="font-mono text-xs text-red-300">Cannot resolve path <span class="text-warm">'{{ $badPath }}'</span></p>
                        <p class="font-mono text-[10px] text-muted/50 mt-0.5">router.ts · line 7 · HTTP 404 Not Found</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- CTAs --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10">
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
