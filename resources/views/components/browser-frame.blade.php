{{-- Browser chrome wrapper for project screenshots.
     Usage: <x-browser-frame url="https://example.com">…image or slot…</x-browser-frame> --}}
@props(['url' => null])
<div>
    {{-- Title bar --}}
    <div class="flex items-center gap-1.5 px-3 py-2 bg-surface-2 border-b border-line">
        <span class="w-2 h-2 rounded-full bg-red-500/40 flex-none" aria-hidden="true"></span>
        <span class="w-2 h-2 rounded-full bg-yellow-400/40 flex-none" aria-hidden="true"></span>
        <span class="w-2 h-2 rounded-full bg-green-500/40 flex-none" aria-hidden="true"></span>
        @if($url)
        <span class="flex-1 mx-2 font-mono text-xs text-muted bg-surface rounded px-2 py-0.5 truncate">
            {{ parse_url($url, PHP_URL_HOST) ?: $url }}
        </span>
        @endif
    </div>
    {{-- Screenshot area --}}
    <div class="relative overflow-hidden aspect-video bg-surface-2">
        {{ $slot }}
    </div>
</div>
