<label {{ $attributes->merge(['class' => 'block text-xs font-semibold text-secondary uppercase tracking-wider mb-2']) }}>
    {{ $slot }}
    @if($attributes->has('required'))
        <span class="text-red-500 ml-0.5">*</span>
    @endif
</label>
