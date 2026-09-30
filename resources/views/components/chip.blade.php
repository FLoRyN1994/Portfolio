{{-- Usage: <x-chip>Drupal</x-chip>  or  <x-chip class="text-warm border-warm/20 bg-warm/10"> --}}
<span {{ $attributes->merge([
    'class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-mono text-xs tracking-wide bg-accent/10 border border-accent/20 text-accent',
]) }}>
    {{ $slot }}
</span>
