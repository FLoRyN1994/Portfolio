{{-- Usage: <x-button-primary href="/projects">See work</x-button-primary>
         or: <x-button-primary type="submit">Send</x-button-primary> --}}
@props(['href' => null])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge([
        'class' => 'inline-flex items-center gap-2 px-6 py-3 bg-accent text-white text-sm font-semibold rounded-xl transition-colors hover:bg-accent/90 outline-none focus-visible:ring-2 focus-visible:ring-accent/60',
    ]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge([
        'class' => 'inline-flex items-center gap-2 px-6 py-3 bg-accent text-white text-sm font-semibold rounded-xl transition-colors hover:bg-accent/90 outline-none focus-visible:ring-2 focus-visible:ring-accent/60',
    ]) }}>{{ $slot }}</button>
@endif
