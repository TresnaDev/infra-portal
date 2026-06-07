@props(['id' => uniqid()])

<div x-data="{ 
    id: '{{ $id }}',
    revealed: false, 
    confirming: false,
    isLoading: false,
    value: null,
    passwordInput: '',
    error: null,
    
    async confirm() {
        if(!this.passwordInput) return;
        
        this.isLoading = true;
        this.error = null;
        
        // LIVEWIRE INTEGRATION PREPARATION:
        // Ketika Livewire diimplementasikan, Anda cukup memanggil method di komponen Livewire:
        // const result = await $wire.revealCredential(this.id, this.passwordInput);
        // if (result.success) { ... }
        
        setTimeout(() => {
            if (this.passwordInput === 'admin') { // Mockup demo
                this.value = 'decrypted-secret-for-' + this.id;
                this.revealed = true;
                this.confirming = false;
                this.passwordInput = '';
            } else {
                this.error = 'Invalid admin password. Try \'admin\'.';
            }
            this.isLoading = false;
        }, 800);
    },
    
    copyToClipboard() {
        if(this.value) {
            navigator.clipboard.writeText(this.value);
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        } else {
            // Prompt to reveal first
            this.confirming = true;
        }
    },
    copied: false
}" class="flex items-center gap-3">
    <div class="font-mono text-xs px-3 py-1.5 bg-accent/5 border border-accent/20 rounded-md text-primary min-w-[120px] flex items-center justify-center cursor-pointer hover:bg-accent/10 transition-colors shadow-inner" @click="!revealed ? confirming = true : revealed = false">
        <span x-show="!revealed" class="tracking-[0.3em] text-accent mt-0.5">••••••••</span>
        <span x-show="revealed" x-cloak class="text-[10px] truncate max-w-[100px] text-green-500 font-bold" x-text="value ? (value.length > 20 ? value.substring(0,10) + '...' : value) : ''"></span>
    </div>
    
    <button @click="!revealed ? confirming = true : revealed = false" class="text-accent hover:text-primary transition-colors focus:outline-none bg-surface border border-accent/20 p-1.5 rounded-md shadow-sm" :title="revealed ? 'Hide' : 'Reveal'">
        <svg x-show="!revealed" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
        <svg x-show="revealed" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
    </button>
    
    <button @click="copyToClipboard()" class="text-accent hover:text-primary transition-colors focus:outline-none bg-surface border border-accent/20 p-1.5 rounded-md shadow-sm" title="Copy to clipboard">
        <svg x-show="!copied" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>
        <svg x-show="copied" x-cloak class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
    </button>

    <!-- Custom Modal for Confirmation -->
    <div x-show="confirming" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="confirming = false">
        <div class="fixed inset-0 transition-opacity" @click="confirming = false">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        </div>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="relative bg-surface rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-sm w-full border border-accent/30" @click.stop>
                <div class="px-6 py-4 border-b border-accent/10 flex items-center justify-between bg-accent/5">
                    <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                        <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Security Verification
                    </h3>
                    <button type="button" @click="confirming = false" class="text-secondary hover:text-red-500 transition-colors focus:outline-none bg-surface p-1 rounded-md border border-accent/20">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="px-6 py-5">
                    <p class="text-sm text-secondary mb-4">Please enter your admin password to decrypt and view this sensitive credential.</p>
                    
                    <div x-show="error" class="mb-4 p-3 bg-red-500/10 border border-red-500/20 rounded-md flex items-start gap-2" style="display:none;">
                        <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        <p class="text-xs text-red-500 font-medium" x-text="error"></p>
                    </div>

                    <x-ui.form.input type="password" x-model="passwordInput" placeholder="Admin password" @keyup.enter="confirm" autofocus x-bind:disabled="isLoading" />
                </div>
                <div class="px-6 py-4 border-t border-accent/10 bg-accent/5 flex justify-end gap-3">
                    <button type="button" @click="confirming = false" class="px-4 py-2 text-sm text-secondary hover:text-primary font-medium transition-colors" x-bind:disabled="isLoading">Cancel</button>
                    <button type="button" @click="confirm" class="px-4 py-2 bg-primary text-surface rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-2" x-bind:disabled="isLoading">
                        <svg x-show="isLoading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-surface" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display:none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isLoading ? 'Decrypting...' : 'Decrypt Secret'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
