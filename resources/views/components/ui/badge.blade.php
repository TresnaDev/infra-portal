@props(['color' => 'primary'])

@php
    $colors = [
        'primary' => 'bg-primary/10 text-primary border border-primary/20',
        'secondary' => 'bg-secondary/10 text-secondary border border-secondary/20',
        'accent' => 'bg-accent/10 text-accent border border-accent/20',
        'success' => 'bg-green-100 text-green-800 border border-green-200',
        'danger' => 'bg-red-100 text-red-800 border border-red-200',
        'warning' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
    ];
    $colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold tracking-wide uppercase $colorClass"]) }}>
    {{ $slot }}
</span>
