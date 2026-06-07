@props(['name', 'title' => '', 'maxWidth' => 'sm'])

@php
$maxWidthClass = match ($maxWidth) {
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    default => 'sm:max-w-2xl',
};
@endphp

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto"
>
    <!-- Backdrop -->
    <div x-show="show" class="fixed inset-0 transition-all transform" x-transition.opacity.duration.300ms x-on:click="show = false">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    </div>

    <!-- Modal Panel -->
    <div x-show="show" 
         class="mb-6 bg-surface rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidthClass }} sm:mx-auto mt-20 border border-accent/30"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        
        @if($title)
            <div class="px-6 py-4 border-b border-accent/30">
                <h3 class="text-lg font-bold text-primary">{{ $title }}</h3>
            </div>
        @endif
        
        <div class="px-6 py-4">
            {{ $slot }}
        </div>
        
        @if(isset($footer))
            <div class="px-6 py-4 bg-accent/5 border-t border-accent/30 flex items-center justify-end gap-3">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
