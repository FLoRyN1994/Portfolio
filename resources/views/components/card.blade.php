{{-- Usage: <x-card class="p-6">...</x-card>  or  <x-card :hover="false"> --}}
@props(['hover' => true])
<div {{ $attributes->merge([
    'class' => 'bg-surface border border-line rounded-3xl overflow-hidden'
        . ($hover ? ' transition-all duration-300 hover:-translate-y-1 hover:bg-surface-2 hover:border-accent/30' : ''),
]) }}>
    {{ $slot }}
</div>
