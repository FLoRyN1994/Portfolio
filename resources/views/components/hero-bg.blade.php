{{-- Reusable hero background: faint 64px blueprint grid + soft radial glows.
     Usage: <x-hero-bg /> inside a relative-positioned container. --}}
<div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
    {{-- Blueprint grid --}}
    <div class="absolute inset-0 blueprint-grid opacity-60"></div>

    {{-- Blue radial glow --}}
    <div class="absolute -top-32 -left-32 w-[700px] h-[700px] rounded-full"
         style="background: radial-gradient(circle, rgba(79,140,255,0.10) 0%, transparent 65%);"></div>

    {{-- Warm amber glow --}}
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full"
         style="background: radial-gradient(circle, rgba(243,182,100,0.06) 0%, transparent 65%);"></div>
</div>
