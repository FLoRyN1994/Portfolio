{{-- Usage: <x-section-label>Stack</x-section-label>  or  <x-section-label label="Stack" /> --}}
@props(['label' => null])
<p {{ $attributes->merge(['class' => 'font-mono text-xs tracking-widest uppercase text-warm']) }}>
    {{ $label ?? $slot }}
</p>
