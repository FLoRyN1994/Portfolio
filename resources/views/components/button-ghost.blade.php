{{-- Usage: <x-button-ghost href="#work">See selected work</x-button-ghost> --}}
@props(['href' => null])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge([
        'class' => 'inline-flex items-center gap-2 px-6 py-3 bg-surface border border-line text-text text-sm font-medium rounded-xl transition-all hover:border-accent/40 hover:bg-surface-2 outline-none focus-visible:ring-2 focus-visible:ring-accent/60',
    ]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge([
        'class' => 'inline-flex items-center gap-2 px-6 py-3 bg-surface border border-line text-text text-sm font-medium rounded-xl transition-all hover:border-accent/40 hover:bg-surface-2 outline-none focus-visible:ring-2 focus-visible:ring-accent/60',
    ]) }}>{{ $slot }}</button>
@endif
