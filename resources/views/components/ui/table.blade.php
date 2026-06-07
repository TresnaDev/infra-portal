<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full text-left border-collapse min-w-max']) }}>
        @if(isset($header))
        <thead>
            {{ $header }}
        </thead>
        @endif
        <tbody class="divide-y divide-accent/30 text-sm">
            {{ $slot }}
        </tbody>
    </table>
</div>
