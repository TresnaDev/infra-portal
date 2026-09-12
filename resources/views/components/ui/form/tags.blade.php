@props(['options' => [], 'placeholder' => 'Add tag...', 'name' => 'tags', 'value' => []])

<div x-data="{
        options: {{ json_encode($options) }},
        selected: @js(is_array($value) ? $value : []),
        search: '',
        openDropdown: false,
        get filteredOptions() {
            return this.options.filter(i => i.toLowerCase().includes(this.search.toLowerCase()) && !this.selected.includes(i));
        },
        selectOption(opt) {
            this.selected.push(opt);
            this.search = '';
            this.openDropdown = false;
            $refs.searchInput.focus();
        },
        removeOption(opt) {
            this.selected = this.selected.filter(i => i !== opt);
        },
        addCustomOption() {
            let val = this.search.trim();
            if(val && !this.selected.includes(val)) {
                this.selected.push(val);
                if(!this.options.includes(val)) this.options.push(val);
            }
            this.search = '';
            this.openDropdown = false;
        }
    }" class="relative w-full z-20">

    <!-- Hidden input to submit the array -->
    <template x-for="tag in selected">
        <input type="hidden" name="{{ $name }}[]" :value="tag">
    </template>

    <div class="min-h-[42px] px-3 py-1.5 bg-transparent border border-accent/30 rounded-md flex flex-wrap gap-2 items-center cursor-text transition-colors focus-within:border-primary focus-within:ring-1 focus-within:ring-primary hover:border-accent/50"
        @click="$refs.searchInput.focus(); openDropdown = true" @click.outside="openDropdown = false">
        <template x-for="tag in selected" :key="tag">
            <span
                class="flex items-center gap-1.5 px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded border border-primary/20">
                <span x-text="tag"></span>
                <button type="button" @click.stop="removeOption(tag)"
                    class="hover:text-red-500 focus:outline-none">&times;</button>
            </span>
        </template>
        <input x-ref="searchInput" x-model="search" @focus="openDropdown = true"
            @keydown.enter.prevent="addCustomOption()"
            @keydown.tab="if(search) { addCustomOption(); $event.preventDefault(); }" type="text"
            placeholder="{{ $placeholder }}"
            class="flex-1 bg-transparent text-sm text-primary placeholder-accent focus:outline-none min-w-[100px] py-1">
    </div>

    <div x-show="openDropdown && filteredOptions.length > 0" x-transition.opacity
        class="absolute left-0 right-0 top-full mt-1 bg-surface border border-accent/30 rounded-md shadow-lg py-1 max-h-48 overflow-y-auto z-50">
        <template x-for="opt in filteredOptions" :key="opt">
            <button type="button" @click.stop="selectOption(opt)"
                class="w-full text-left px-4 py-2 text-sm text-secondary hover:text-primary hover:bg-accent/10 transition-colors focus:outline-none">
                <span x-text="opt"></span>
            </button>
        </template>
    </div>
</div>