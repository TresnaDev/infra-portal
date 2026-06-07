@props(['total' => 0, 'from' => 0, 'to' => 0])

<div class="px-6 py-4 border-t border-accent/30 bg-surface/50 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div class="text-xs text-secondary">
        Showing <span class="font-semibold text-primary">{{ $from }}</span> to <span class="font-semibold text-primary">{{ $to }}</span> of <span class="font-semibold text-primary">{{ $total }}</span> results
    </div>
    <div class="flex items-center gap-1">
        {{ $slot }}
    </div>
</div>
