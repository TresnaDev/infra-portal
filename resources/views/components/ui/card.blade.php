@props(['title' => null, 'padding' => 'p-6'])

<div {{ $attributes->merge(['class' => 'bg-surface rounded-md ' . $padding]) }}>
    @if($title)
        <h3 class="text-lg font-bold text-primary mb-4">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
