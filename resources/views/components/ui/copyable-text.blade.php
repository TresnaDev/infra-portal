@props(['text' => ''])

<div x-data="{ copied: false }" class="inline-flex items-center gap-1.5 group">
    <span>{{ $text }}</span>
    @if($text !== '-')
        <button type="button" @click="navigator.clipboard.writeText('{{ $text }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                class="text-accent opacity-0 group-hover:opacity-100 hover:text-primary transition-all focus:outline-none" 
                title="Copy to clipboard">
            <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
            <svg x-show="copied" style="display: none;" class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
        </button>
    @endif
</div>
