@php
    $classes = 'font-semibold border-accent/30 text-secondary text-left';
    $customClass = $attributes->get('class', '');
    if (!str_contains($customClass, 'px-')) $classes .= ' px-6';
    if (!str_contains($customClass, 'py-')) $classes .= ' py-4';
    if (str_contains($customClass, 'text-center')) $classes = str_replace('text-left', '', $classes);
@endphp
<th {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</th>
