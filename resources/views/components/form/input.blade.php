@props(['id', 'label' => null, 'type' => 'text', 'name', 'placeholder' => '', 'required' => false])

<div>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium mb-1.5">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" 
        class="w-full px-4 py-2.5 rounded-md border border-accent/40 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-sm" 
        placeholder="{{ $placeholder }}" 
        {{ $required ? 'required' : '' }}
        {{ $attributes }}>
</div>
