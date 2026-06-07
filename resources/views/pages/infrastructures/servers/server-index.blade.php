@extends('layouts.app')

@section('content')
    <div class="w-full">
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-primary mb-1">Servers</h1>
                <p class="text-secondary text-sm">Manage your infrastructure servers and technical specifications.</p>
            </div>
            <a href="{{ route('infrastructures.servers.create') }}" class="bg-primary text-surface px-4 py-2 rounded-md text-sm font-semibold hover:bg-primary/90 transition-colors shadow-sm flex items-center justify-center gap-2 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Server
            </a>
        </div>

        <!-- Table Card -->
        <x-ui.card class="bg-surface border border-accent/30 overflow-hidden p-0!">
            <!-- Toolbar: Search & Filters -->
            <div class="p-4 border-b border-accent/30 flex flex-col sm:flex-row gap-4 items-center justify-between bg-surface/50">
                <!-- Left: Quick Status Filters -->
                <div class="flex items-center gap-1 bg-surface border border-accent/30 p-1 rounded-md w-full sm:w-auto overflow-x-auto">
                    <button type="button" class="px-3 py-1.5 text-xs font-semibold rounded bg-primary/10 text-primary transition-colors whitespace-nowrap">
                        All <span class="ml-1 px-1.5 py-0.5 rounded-full bg-primary/20 text-[10px]">12</span>
                    </button>
                    <button type="button" class="px-3 py-1.5 text-xs font-medium rounded text-secondary hover:text-primary hover:bg-accent/10 transition-colors whitespace-nowrap">
                        Active <span class="ml-1 px-1.5 py-0.5 rounded-full bg-accent/20 text-[10px]">10</span>
                    </button>
                    <button type="button" class="px-3 py-1.5 text-xs font-medium rounded text-secondary hover:text-primary hover:bg-accent/10 transition-colors whitespace-nowrap">
                        Inactive <span class="ml-1 px-1.5 py-0.5 rounded-full bg-accent/20 text-[10px]">2</span>
                    </button>
                </div>

                <!-- Right: Search & Advanced Filter -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex-1 sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-accent">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" placeholder="Search servers..." class="w-full pl-9 pr-4 py-1.5 bg-transparent border border-accent/30 rounded-md text-sm text-primary placeholder-accent focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>
                    <div class="relative" x-data="{ open: false, popupStyle: '' }">
                        <button x-ref="btn" @click="open = !open; if(open) popupStyle = `top: ${$refs.btn.getBoundingClientRect().bottom + 8}px; left: ${$refs.btn.getBoundingClientRect().right - 256}px;`" class="p-2 border border-accent/30 rounded-md text-accent hover:text-primary hover:bg-accent/10 transition-colors focus:outline-none" title="Advanced Filters">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                        </button>
                        
                        <!-- Advanced Filter Popup -->
                        <template x-teleport="body">
                            <div x-show="open" 
                                 @click.outside="open = false"
                                 @scroll.window="open = false"
                                 @resize.window="open = false"
                                 x-transition.opacity.duration.200ms
                                 class="fixed w-64 p-4 rounded-md shadow-lg bg-surface border border-accent/30 z-100"
                                 :style="popupStyle"
                                 style="display: none;">
                                <h4 class="text-xs font-semibold text-primary uppercase tracking-wider mb-3">Advanced Filters</h4>
                                <div class="space-y-3">
                                    <!-- Multi-Select Tags -->
                                    <div x-data="{
                                        options: ['app', 'database', 'storage', 'production', 'staging'],
                                        selected: [],
                                        search: '',
                                        openDropdown: false,
                                        get filteredOptions() {
                                            return this.options.filter(i => i.includes(this.search.toLowerCase()) && !this.selected.includes(i));
                                        },
                                        selectOption(opt) {
                                            this.selected.push(opt);
                                            this.search = '';
                                            this.openDropdown = false;
                                            $refs.searchInput.focus();
                                        },
                                        removeOption(opt) {
                                            this.selected = this.selected.filter(i => i !== opt);
                                        }
                                    }" class="relative z-30">
                                        <label class="block text-xs text-secondary mb-1">Tags / Labels</label>
                                        <div class="min-h-[34px] p-1.5 bg-transparent border border-accent/30 rounded flex flex-wrap gap-1 items-center cursor-text transition-colors focus-within:border-primary focus-within:ring-1 focus-within:ring-primary" @click="$refs.searchInput.focus(); openDropdown = true" @click.outside="openDropdown = false">
                                            <template x-for="tag in selected" :key="tag">
                                                <span class="flex items-center gap-1 px-1.5 py-0.5 bg-primary/10 text-primary text-[10px] font-medium rounded border border-primary/20">
                                                    <span x-text="tag"></span>
                                                    <button type="button" @click.stop="removeOption(tag)" class="hover:text-red-500 focus:outline-none">&times;</button>
                                                </span>
                                            </template>
                                            <input x-ref="searchInput" x-model="search" @focus="openDropdown = true" @keydown.enter.prevent="if(filteredOptions.length > 0) selectOption(filteredOptions[0])" type="text" placeholder="Add tag..." class="flex-1 bg-transparent text-xs text-primary focus:outline-none min-w-[60px] px-1">
                                        </div>
                                        <div x-show="openDropdown && filteredOptions.length > 0" x-transition.opacity class="absolute z-50 left-0 right-0 top-full mt-1 bg-surface border border-accent/30 rounded-md shadow-lg py-1 max-h-32 overflow-y-auto">
                                            <template x-for="opt in filteredOptions" :key="opt">
                                                <button type="button" @click.stop="selectOption(opt)" class="w-full text-left px-3 py-1.5 text-xs text-secondary hover:text-primary hover:bg-accent/10 transition-colors focus:outline-none">
                                                    <span x-text="opt"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Custom Location Dropdown -->
                                    <div x-data="{ locOpen: false, selectedLoc: 'All Locations' }" class="relative z-20">
                                        <label class="block text-xs text-secondary mb-1">Location</label>
                                        <button type="button" @click="locOpen = !locOpen" @click.outside="locOpen = false" class="w-full flex items-center justify-between px-3 py-1.5 bg-transparent border border-accent/30 rounded text-xs text-secondary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-colors">
                                            <span x-text="selectedLoc"></span>
                                            <svg class="w-3 h-3 text-accent transition-transform duration-200" :class="locOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </button>
                                        <div x-show="locOpen" x-transition.opacity class="absolute z-50 left-0 right-0 top-full mt-1 bg-surface border border-accent/30 rounded-md shadow-lg py-1">
                                            <template x-for="opt in ['All Locations', 'AWS', 'DigitalOcean', 'On-Premise']">
                                                <button type="button" @click="selectedLoc = opt; locOpen = false" class="w-full text-left px-3 py-1.5 text-xs text-secondary hover:text-primary hover:bg-accent/10 transition-colors focus:outline-none">
                                                    <span x-text="opt"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Custom Sort Dropdown -->
                                    <div x-data="{ sortOpen: false, selectedSort: 'Name (A-Z)' }" class="relative z-10">
                                        <label class="block text-xs text-secondary mb-1">Sort By</label>
                                        <button type="button" @click="sortOpen = !sortOpen" @click.outside="sortOpen = false" class="w-full flex items-center justify-between px-3 py-1.5 bg-transparent border border-accent/30 rounded text-xs text-secondary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-colors">
                                            <span x-text="selectedSort"></span>
                                            <svg class="w-3 h-3 text-accent transition-transform duration-200" :class="sortOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </button>
                                        <div x-show="sortOpen" x-transition.opacity class="absolute z-50 left-0 right-0 top-full mt-1 bg-surface border border-accent/30 rounded-md shadow-lg py-1">
                                            <template x-for="opt in ['Name (A-Z)', 'Recently Added', 'IP Address']">
                                                <button type="button" @click="selectedSort = opt; sortOpen = false" class="w-full text-left px-3 py-1.5 text-xs text-secondary hover:text-primary hover:bg-accent/10 transition-colors focus:outline-none">
                                                    <span x-text="opt"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end gap-2 border-t border-accent/30 pt-3">
                                    <button @click="open = false" class="px-3 py-1.5 text-xs text-secondary hover:text-primary transition-colors focus:outline-none">Cancel</button>
                                    <button class="px-3 py-1.5 bg-primary text-surface rounded text-xs font-medium hover:bg-primary/90 transition-colors focus:outline-none">Apply Filters</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <x-ui.table>
                    <x-slot name="header">
                        <tr class="bg-accent/5 border-b border-accent/30 text-xs text-secondary uppercase tracking-wider">
                            <x-ui.table.th rowspan="2" class="border-r align-middle w-16">No</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle">Server Name</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle text-center">Apps</x-ui.table.th>
                            <x-ui.table.th colspan="3" class="border-b border-r text-center py-2">IP Address</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle text-center">Credentials</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle">Specifications</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle">Location</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="border-r align-middle">Administrator</x-ui.table.th>
                            <x-ui.table.th rowspan="2" class="text-center align-middle">Actions</x-ui.table.th>
                        </tr>
                        <tr class="bg-accent/5 border-b border-accent/30 text-xs text-secondary uppercase tracking-wider">
                            <x-ui.table.th class="border-r py-2">VPC</x-ui.table.th>
                            <x-ui.table.th class="border-r py-2">Private</x-ui.table.th>
                            <x-ui.table.th class="border-r py-2">Public</x-ui.table.th>
                        </tr>
                    </x-slot>
                                            <!-- Row 1 -->
                        <x-ui.table.tr>
                            <x-ui.table.td class="align-top text-secondary">1</x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="font-semibold text-primary mb-2">App-Prod-01</div>
                                <div class="flex flex-wrap gap-1">
                                    <x-ui.badge color="secondary">app</x-ui.badge>
                                    <x-ui.badge color="secondary">production</x-ui.badge>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#applications" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                                    3 Apps
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="vpc-1a2b3c" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="10.0.1.10" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="203.0.113.10" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#credentials" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    2 Keys
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-xs">
                                    <div><span class="text-accent">OS:</span> <span class="font-medium text-secondary">Ubuntu 22.04</span></div>
                                    <div><span class="text-accent">CPU:</span> <span class="font-medium text-secondary">8 Cores</span></div>
                                    <div><span class="text-accent">RAM:</span> <span class="font-medium text-secondary">16 GB</span></div>
                                    <div><span class="text-accent">Disk:</span> <span class="font-medium text-secondary">250GB NVMe</span></div>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">On Premise Baliyoni</div>
                                <div class="text-xs text-accent line-clamp-2">Jakarta, Duren Tiga - 02</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">Bizdev Team</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <x-ui.action-menu>
                                    <x-ui.action-item href="{{ route('infrastructures.servers.show', 1) }}" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>'>
                                        View Details
                                    </x-ui.action-item>
                                    <x-ui.action-item href="#" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'>
                                        Edit Server
                                    </x-ui.action-item>
                                    <div class="border-t border-accent/30 my-1"></div>
                                    <x-ui.action-item href="#" :danger="true" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>'>
                                        Delete
                                    </x-ui.action-item>
                                </x-ui.action-menu>
                            </x-ui.table.td>
                        </x-ui.table.tr>

                        <!-- Row 2 -->
                        <x-ui.table.tr>
                            <x-ui.table.td class="align-top text-secondary">2</x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="font-semibold text-primary mb-2">DB-Master-01</div>
                                <div class="flex flex-wrap gap-1">
                                    <x-ui.badge color="secondary">database</x-ui.badge>
                                    <x-ui.badge color="secondary">production</x-ui.badge>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#applications" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                                    3 Apps
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="vpc-1a2b3c" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="10.0.1.50" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-accent text-xs">
                                <x-ui.copyable-text text="-" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#credentials" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    2 Keys
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-xs">
                                    <div><span class="text-accent">OS:</span> <span class="font-medium text-secondary">Debian 12</span></div>
                                    <div><span class="text-accent">CPU:</span> <span class="font-medium text-secondary">16 Cores</span></div>
                                    <div><span class="text-accent">RAM:</span> <span class="font-medium text-secondary">64 GB</span></div>
                                    <div><span class="text-accent">Disk:</span> <span class="font-medium text-secondary">1TB SSD</span></div>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">On Premise Baliyoni</div>
                                <div class="text-xs text-accent line-clamp-2">Jakarta, Duren Tiga - 02</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">Pak Dewa</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <x-ui.action-menu>
                                    <x-ui.action-item href="{{ route('infrastructures.servers.show', 1) }}" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>'>
                                        View Details
                                    </x-ui.action-item>
                                    <x-ui.action-item href="#" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'>
                                        Edit Server
                                    </x-ui.action-item>
                                    <div class="border-t border-accent/30 my-1"></div>
                                    <x-ui.action-item href="#" :danger="true" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>'>
                                        Delete
                                    </x-ui.action-item>
                                </x-ui.action-menu>
                            </x-ui.table.td>
                        </x-ui.table.tr>

                        <!-- Row 3 -->
                        <x-ui.table.tr>
                            <x-ui.table.td class="align-top text-secondary">3</x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="font-semibold text-primary mb-2">Worker-Queue-01</div>
                                <div class="flex flex-wrap gap-1">
                                    <x-ui.badge color="secondary">app</x-ui.badge>
                                    <x-ui.badge color="secondary">staging</x-ui.badge>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#applications" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                                    3 Apps
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="vpc-9z8y7x" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-secondary text-xs">
                                <x-ui.copyable-text text="10.0.2.15" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top font-mono text-accent text-xs">
                                <x-ui.copyable-text text="-" />
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <a href="{{ route('infrastructures.servers.show', 1) }}#credentials" class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent/10 hover:bg-accent/20 text-primary text-xs font-medium rounded-md transition-colors border border-accent/20">
                                    <svg class="w-3.5 h-3.5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    2 Keys
                                </a>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top">
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-xs">
                                    <div><span class="text-accent">OS:</span> <span class="font-medium text-secondary">Ubuntu 22.04</span></div>
                                    <div><span class="text-accent">CPU:</span> <span class="font-medium text-secondary">4 Cores</span></div>
                                    <div><span class="text-accent">RAM:</span> <span class="font-medium text-secondary">8 GB</span></div>
                                    <div><span class="text-accent">Disk:</span> <span class="font-medium text-secondary">100GB SSD</span></div>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">On Premise Baliyoni</div>
                                <div class="text-xs text-accent line-clamp-2">Jakarta, Duren Tiga - 02</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-top min-w-[200px] max-w-[250px] whitespace-normal">
                                <div class="font-medium text-primary mb-1">Pak Agung</div>
                            </x-ui.table.td>
                            <x-ui.table.td class="align-middle text-center">
                                <x-ui.action-menu>
                                    <x-ui.action-item href="{{ route('infrastructures.servers.show', 1) }}" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>'>
                                        View Details
                                    </x-ui.action-item>
                                    <x-ui.action-item href="#" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'>
                                        Edit Server
                                    </x-ui.action-item>
                                    <div class="border-t border-accent/30 my-1"></div>
                                    <x-ui.action-item href="#" :danger="true" icon='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>'>
                                        Delete
                                    </x-ui.action-item>
                                </x-ui.action-menu>
                            </x-ui.table.td>
                        </x-ui.table.tr>

                </x-ui.table>

            <!-- Pagination (Dummy) -->
            <x-ui.pagination :from="1" :to="3" :total="12">
                <button class="px-3 py-1.5 border border-accent/30 rounded-md text-xs font-medium text-secondary hover:text-primary hover:bg-accent/10 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Prev
                </button>
                <button class="px-3 py-1.5 bg-primary/10 border border-primary/30 rounded-md text-xs text-primary font-bold">
                    1
                </button>
                <button class="px-3 py-1.5 border border-accent/30 rounded-md text-xs font-medium text-secondary hover:text-primary hover:bg-accent/10 transition-colors">
                    2
                </button>
                <button class="px-3 py-1.5 border border-accent/30 rounded-md text-xs font-medium text-secondary hover:text-primary hover:bg-accent/10 transition-colors">
                    3
                </button>
                <span class="px-2 text-secondary text-xs">...</span>
                <button class="px-3 py-1.5 border border-accent/30 rounded-md text-xs font-medium text-secondary hover:text-primary hover:bg-accent/10 transition-colors">
                    Next
                </button>
            </x-ui.pagination>
        </x-ui.card>
    </div>
@endsection
