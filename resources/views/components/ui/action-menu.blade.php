<div x-data="{ open: false, popupStyle: '' }" class="relative inline-block text-center align-middle">
    <button type="button" x-ref="btn" @click="open = !open; if(open) popupStyle = `top: ${$refs.btn.getBoundingClientRect().bottom + 4}px; left: ${$refs.btn.getBoundingClientRect().right - 160}px;`" class="text-accent hover:text-primary transition-colors p-1 rounded hover:bg-accent/10 focus:outline-none" title="Options">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
    </button>
    
    <template x-teleport="body">
        <div x-show="open" 
             @click.outside="open = false"
             @scroll.window="open = false"
             @resize.window="open = false"
             x-transition.opacity.duration.200ms
             class="fixed w-40 rounded-md shadow-lg bg-surface border border-accent/30 z-100"
             :style="popupStyle"
             style="display: none;">
            <div class="py-1 flex flex-col text-left">
                {{ $slot }}
            </div>
        </div>
    </template>
</div>
