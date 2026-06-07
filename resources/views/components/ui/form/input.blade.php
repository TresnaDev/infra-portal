@props(['disabled' => false, 'error' => false])

@php
    $baseClasses = 'w-full px-4 py-2 bg-transparent border rounded-md text-sm transition-colors focus:outline-none focus:ring-1';
    $stateClasses = $error 
        ? 'border-red-500/50 text-red-500 focus:border-red-500 focus:ring-red-500 placeholder-red-500/30' 
        : 'border-accent/30 text-primary placeholder-accent focus:border-primary focus:ring-primary hover:border-accent/50';
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed bg-accent/5' : '';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => "$baseClasses $stateClasses $disabledClasses"]) }}>
