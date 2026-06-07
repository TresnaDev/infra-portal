@props(['href' => '#', 'icon' => null, 'danger' => false])

@php
    $baseClasses = 'flex items-center gap-2 px-4 py-2 text-xs transition-colors';
    $colorClasses = $danger 
        ? 'text-red-500 hover:text-red-400 hover:bg-red-500/10' 
        : 'text-secondary hover:text-primary hover:bg-accent/10';
    $classes = $baseClasses . ' ' . $colorClasses;
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="w-4 h-4 flex items-center justify-center">
            {!! $icon !!}
        </span>
    @endif
    {{ $slot }}
</a>
