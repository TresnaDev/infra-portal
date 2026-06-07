@props(['disabled' => false, 'error' => false])

@php
    $baseClasses = 'w-full px-4 py-2 bg-transparent border rounded-md text-sm transition-colors focus:outline-none focus:ring-1 appearance-none cursor-pointer';
    $stateClasses = $error 
        ? 'border-red-500/50 text-red-500 focus:border-red-500 focus:ring-red-500' 
        : 'border-accent/30 text-primary focus:border-primary focus:ring-primary hover:border-accent/50';
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed bg-accent/5' : '';
@endphp

<div class="relative">
    <select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => "$baseClasses $stateClasses $disabledClasses"]) }}>
        {{ $slot }}
    </select>
    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none {{ $error ? 'text-red-500' : 'text-accent' }}">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
    </div>
</div>
