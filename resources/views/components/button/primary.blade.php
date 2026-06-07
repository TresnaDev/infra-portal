@props(['type' => 'submit'])

<button type="{{ $type }}" 
    {{ $attributes->merge(['class' => 'w-full bg-primary hover:bg-[#1a1a1a] text-surface font-medium py-3 px-4 rounded-md transition-colors duration-200 text-sm']) }}>
    {{ $slot }}
</button>
