@props(['id', 'label' => null, 'name', 'placeholder' => '••••••••', 'required' => false])

<div x-data="{ showPassword: false }">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium mb-1.5">{{ $label }}</label>
    @endif
    <div class="relative">
        <input :type="showPassword ? 'text' : 'password'" id="{{ $id }}" name="{{ $name }}" 
            class="w-full px-4 py-2.5 rounded-md border border-accent/40 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-sm" 
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}
            {{ $attributes }}>
        <!-- Toggle Button -->
        <button type="button" @click="showPassword = !showPassword" 
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-accent hover:text-primary transition-colors focus:outline-none"
            aria-label="Toggle password visibility">
            <!-- Eye Icon (Hidden Password) -->
            <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Eye Slash Icon (Visible Password) -->
            <svg x-show="showPassword" style="display: none;" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
        </button>
    </div>
</div>
