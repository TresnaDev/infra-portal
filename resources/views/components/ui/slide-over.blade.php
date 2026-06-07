@props(['show', 'title' => ''])

<div x-show="{{ $show }}" style="display: none;" class="fixed inset-0 overflow-hidden z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
        <!-- Background overlay -->
        <div x-show="{{ $show }}"
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
             @click="{{ $show }} = false"></div>

        <div class="fixed inset-y-0 right-0 max-w-md w-full flex">
            <!-- Slide-over panel -->
            <div x-show="{{ $show }}"
                 x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="w-full h-full">
                <div class="flex flex-col h-full bg-surface border-l border-accent/30 shadow-2xl overflow-y-auto">
                    <div class="px-6 py-4 border-b border-accent/10 bg-accent/5 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-primary flex items-center gap-2">
                            @if(isset($icon))
                                {{ $icon }}
                            @endif
                            {{ $title }}
                        </h2>
                        <button type="button" @click="{{ $show }} = false" class="text-secondary hover:text-red-500 transition-colors focus:outline-none bg-surface p-1 rounded-md border border-accent/20">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    
                    <div class="flex-1 px-6 py-6 space-y-6">
                        {{ $slot }}
                    </div>

                    @if (isset($footer))
                    <div class="px-6 py-4 border-t border-accent/10 bg-accent/5 flex justify-end gap-3">
                        {{ $footer }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
