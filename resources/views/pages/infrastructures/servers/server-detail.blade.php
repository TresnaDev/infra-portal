@extends('layouts.app')

@section('title', 'Server Details - Infra Portal')

@section('content')
    <div class="w-full space-y-6" x-data="{ activeTab: window.location.hash ? window.location.hash.substring(1) : 'overview', addCredentialOpen: false, assignAppOpen: false }" @hashchange.window="activeTab = window.location.hash ? window.location.hash.substring(1) : 'overview'">
        
        <!-- Premium Header Banner -->
        <div class="bg-surface border border-accent/30 rounded-xl shadow-sm overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-primary via-primary/80 to-accent/50"></div>
            <div class="p-6 pb-0">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                    <div class="flex items-start md:items-center gap-4">
                        <a href="{{ route('infrastructures.servers.index') }}" class="p-2 text-secondary hover:text-primary transition-colors bg-accent/5 hover:bg-accent/10 border border-accent/20 rounded-lg shadow-sm focus:outline-none" title="Back to Servers">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div>
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl font-bold tracking-tight text-primary">App-Prod-01</h1>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-500/10 text-green-500 border border-green-500/20 flex items-center gap-1.5 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Active
                                </span>
                            </div>
                            <div class="flex items-center flex-wrap gap-2 mt-2">
                                <x-ui.badge color="secondary">app</x-ui.badge>
                                <x-ui.badge color="secondary">production</x-ui.badge>
                                <span class="text-xs text-secondary ml-2 flex items-center gap-1.5 font-medium border-l border-accent/30 pl-3">
                                    <svg class="w-3.5 h-3.5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Uptime: 45 days, 12 hrs
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <button class="flex-1 md:flex-none justify-center px-4 py-2 bg-surface border border-accent/30 text-primary rounded-lg text-sm font-semibold hover:bg-accent/5 transition-colors focus:outline-none flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                            Reboot
                        </button>
                        <button class="flex-1 md:flex-none justify-center px-4 py-2 bg-primary text-surface rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors focus:outline-none flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Edit Server
                        </button>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <nav class="flex overflow-x-auto no-scrollbar gap-8 border-b border-accent/20">
                    <a href="#overview" @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'border-primary text-primary font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-accent/50 font-medium'" class="py-3.5 border-b-2 text-sm transition-all whitespace-nowrap">
                        Overview
                    </a>
                    <a href="#credentials" @click="activeTab = 'credentials'" :class="activeTab === 'credentials' ? 'border-primary text-primary font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-accent/50 font-medium'" class="py-3.5 border-b-2 text-sm transition-all flex items-center gap-2 whitespace-nowrap">
                        Credentials
                        <span :class="activeTab === 'credentials' ? 'bg-primary text-surface' : 'bg-accent/10 text-secondary'" class="px-2 py-0.5 rounded-full text-[10px] font-bold transition-colors">2</span>
                    </a>
                    <a href="#applications" @click="activeTab = 'applications'" :class="activeTab === 'applications' ? 'border-primary text-primary font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-accent/50 font-medium'" class="py-3.5 border-b-2 text-sm transition-all flex items-center gap-2 whitespace-nowrap">
                        Applications
                        <span :class="activeTab === 'applications' ? 'bg-primary text-surface' : 'bg-accent/10 text-secondary'" class="px-2 py-0.5 rounded-full text-[10px] font-bold transition-colors">3</span>
                    </a>
                    <a href="#monitoring" @click="activeTab = 'monitoring'" :class="activeTab === 'monitoring' ? 'border-primary text-primary font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-accent/50 font-medium'" class="py-3.5 border-b-2 text-sm transition-all flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
                        Metrics & Logs
                    </a>
                </nav>
            </div>
        </div>

        <!-- Tab Contents -->
        <div class="relative">
            <!-- 1. OVERVIEW TAB -->
            <div x-show="activeTab === 'overview'" class="space-y-6">
                <!-- Quick Stats -->
                <!-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <x-ui.card class="bg-surface border border-accent/30 flex items-center p-4 gap-4 hover:border-primary/30 transition-colors">
                        <div class="p-3 bg-blue-500/10 text-blue-500 rounded-lg shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" /></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="text-[10px] text-secondary font-bold uppercase tracking-wider">CPU Load</div>
                                <div class="text-xs font-bold text-blue-500">12.4%</div>
                            </div>
                            <div class="w-full bg-accent/10 rounded-full h-1.5"><div class="bg-blue-500 h-1.5 rounded-full" style="width: 12.4%"></div></div>
                        </div>
                    </x-ui.card>
                    <x-ui.card class="bg-surface border border-accent/30 flex items-center p-4 gap-4 hover:border-primary/30 transition-colors">
                        <div class="p-3 bg-purple-500/10 text-purple-500 rounded-lg shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="text-[10px] text-secondary font-bold uppercase tracking-wider">RAM Usage</div>
                                <div class="text-xs font-bold text-purple-500">51%</div>
                            </div>
                            <div class="w-full bg-accent/10 rounded-full h-1.5"><div class="bg-purple-500 h-1.5 rounded-full" style="width: 51%"></div></div>
                        </div>
                    </x-ui.card>
                    <x-ui.card class="bg-surface border border-accent/30 flex items-center p-4 gap-4 hover:border-primary/30 transition-colors">
                        <div class="p-3 bg-orange-500/10 text-orange-500 rounded-lg shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="text-[10px] text-secondary font-bold uppercase tracking-wider">Disk I/O</div>
                                <div class="text-xs font-bold text-orange-500">Normal</div>
                            </div>
                            <div class="text-xs text-primary font-medium">Read 2MB/s</div>
                        </div>
                    </x-ui.card>
                    <x-ui.card class="bg-surface border border-accent/30 flex items-center p-4 gap-4 hover:border-primary/30 transition-colors">
                        <div class="p-3 bg-green-500/10 text-green-500 rounded-lg shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="text-[10px] text-secondary font-bold uppercase tracking-wider">Bandwidth</div>
                                <div class="text-xs font-bold text-green-500">Active</div>
                            </div>
                            <div class="text-xs text-primary font-medium">Tx 12Mb / Rx 45Mb</div>
                        </div>
                    </x-ui.card>
                </div> -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <x-ui.card class="border-accent/30 p-0 overflow-hidden">
                        <div class="bg-accent/5 px-5 py-4 border-b border-accent/30 flex items-center gap-3">
                            <div class="p-1.5 bg-surface border border-accent/20 rounded shadow-sm text-primary">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            </div>
                            <h3 class="font-bold text-primary text-sm uppercase tracking-wide">Network Information</h3>
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">VPC ID</span>
                                <div class="text-sm font-mono text-primary"><x-ui.copyable-text text="vpc-1a2b3c" /></div>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">Private IP</span>
                                <div class="text-sm font-mono text-primary"><x-ui.copyable-text text="10.0.1.10" /></div>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">Public IP</span>
                                <div class="text-sm font-mono text-primary"><x-ui.copyable-text text="203.0.113.10" /></div>
                            </div>
                        </div>
                    </x-ui.card>

                    <x-ui.card class="border-accent/30 p-0 overflow-hidden">
                        <div class="bg-accent/5 px-5 py-4 border-b border-accent/30 flex items-center gap-3">
                            <div class="p-1.5 bg-surface border border-accent/20 rounded shadow-sm text-primary">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg>
                            </div>
                            <h3 class="font-bold text-primary text-sm uppercase tracking-wide">Hardware Specs</h3>
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">Operating System</span>
                                <div class="flex items-center gap-2 text-sm text-primary font-medium">
                                    <svg class="w-4 h-4 text-orange-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.176 17.15c-.246.368-.695.532-1.096.398l-3.32-.113c-.15.485-.38 1.05-.694 1.636l2.128 2.534c.265.317.218.78-.104 1.036-.32.257-.792.21-1.056-.108l-2.164-2.58c-.53.49-1.12.92-1.758 1.258l.643 3.255c.088.44-.194.86-.632.95-.436.088-.858-.194-.946-.632l-.65-3.3c-1.32.213-2.73.12-4.08-.28l-2.028 2.65c-.267.35-.74.42-1.09.15-.35-.27-.42-.74-.15-1.09l1.986-2.59c-.93-.72-1.74-1.61-2.39-2.61l-3.2.98c-.42.13-.86-.11-1-.53-.13-.42.11-.86.53-1l3.24-.99c-.19-.74-.3-1.5-.32-2.28L1.135 12.3c-.44-.06-.75-.46-.69-.9.06-.44.46-.75.9-.69l3.32.48c.2-.95.55-1.85 1.05-2.69l-2.6-2.18c-.34-.28-.39-.76-.11-1.1.28-.34.76-.39 1.1-.11l2.67 2.24c.73-.78 1.57-1.44 2.51-1.95l-1-3.15c-.14-.42.08-.87.5-.1.42.14.87-.08 1-.5l1.03 3.2c1.23-.33 2.53-.45 3.82-.33l1.58-2.91c.21-.39.69-.53 1.08-.32.39.21.53.69.32 1.08l-1.63 3.01c1.07.61 2.03 1.39 2.85 2.29l3.05-1.29c.41-.17.88.02 1.05.43.17.41-.02.88-.43 1.05l-3.1 1.31c.3.83.51 1.71.61 2.62l3.31-.22c.44-.03.82.3.85.74.03.44-.3.82-.74.85l-3.36.22c-.17 1.04-.49 2.05-.96 2.99l2.84 1.83c.37.24.48.74.24 1.11z"/></svg>
                                    Ubuntu 22.04 LTS
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">CPU Cores</span>
                                <span class="text-sm text-primary font-medium">8 Cores</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">Memory (RAM)</span>
                                <span class="text-sm text-primary font-medium">16 GB</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-accent/10 last:border-0">
                                <span class="text-xs text-secondary font-medium">Storage</span>
                                <span class="text-sm text-primary font-medium">250GB NVMe SSD</span>
                            </div>
                        </div>
                    </x-ui.card>

                    <x-ui.card class="md:col-span-2 border-accent/30 p-0 overflow-hidden">
                        <div class="bg-accent/5 px-5 py-4 border-b border-accent/30 flex items-center gap-3">
                            <div class="p-1.5 bg-surface border border-accent/20 rounded shadow-sm text-primary">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <h3 class="font-bold text-primary text-sm uppercase tracking-wide">Placement & Administration</h3>
                        </div>
                        <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-accent/10">
                                    <span class="text-xs text-secondary font-medium">Provider</span>
                                    <span class="text-sm text-primary font-medium flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-orange-500/10 flex items-center justify-center text-orange-500"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14.07 15.65c-.5.48-1.22.84-2.07.84-1.53 0-2.48-1.12-2.48-2.6 0-1.57 1.05-2.62 2.53-2.62.8 0 1.48.33 1.94.82L15 11.2c-.75-.72-1.74-1.2-2.94-1.2-2.3 0-4.13 1.77-4.13 4 0 2.2 1.75 3.97 4.02 3.97 1.2 0 2.26-.52 3-1.3l-1.1-1.02zM21 13h-2v-2h-1.5v2h-2v1.5h2v2H19v-2h2zM3 14h6v-1.5H3V14z"/></svg></div>
                                        AWS
                                    </span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-accent/10">
                                    <span class="text-xs text-secondary font-medium">Location Region</span>
                                    <span class="text-sm text-primary font-medium">ap-southeast-1</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-accent/10">
                                    <span class="text-xs text-secondary font-medium">Administrator</span>
                                    <span class="text-sm text-primary font-medium flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=On+Premise&background=random" class="w-5 h-5 rounded-full">
                                        On Premise Baliyoni
                                    </span>
                                </div>
                                <div class="flex flex-col py-2 border-b border-accent/10">
                                    <span class="text-xs text-secondary font-medium mb-1">Notes</span>
                                    <span class="text-sm text-secondary italic">Main application server for user portal. Requires high availability.</span>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>
                </div>
            </div>

            <!-- 2. CREDENTIALS TAB -->
            <div x-show="activeTab === 'credentials'" style="display: none;" class="space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-primary">Access Credentials</h3>
                        <p class="text-sm text-secondary mt-1">Manage SSH keys, passwords, and access tokens for this server.</p>
                    </div>
                    <button @click="addCredentialOpen = true" class="bg-primary text-surface px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Add Credential
                    </button>
                </div>
                
                <x-ui.card class="bg-surface border border-accent/30 overflow-hidden p-0! shadow-sm">
                    <x-ui.table>
                        <x-slot name="header">
                            <tr class="bg-accent/5 border-b border-accent/30 text-xs text-secondary uppercase tracking-wider">
                                <x-ui.table.th class="border-r border-accent/10">Type / Role</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Username</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Port</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Auth Method</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Status</x-ui.table.th>
                                <x-ui.table.th>Secret / Key</x-ui.table.th>
                            </tr>
                        </x-slot>
                        <x-ui.table.tr class="hover:bg-accent/5 transition-colors">
                            <x-ui.table.td>
                                <div class="font-bold text-primary">Root Access</div>
                                <div class="text-[11px] text-accent mt-0.5">Full system administration</div>
                            </x-ui.table.td>
                            <x-ui.table.td><x-ui.copyable-text text="root" /></x-ui.table.td>
                            <x-ui.table.td class="font-mono text-xs"><x-ui.copyable-text text="22" /></x-ui.table.td>
                            <x-ui.table.td>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs text-secondary font-medium">
                                    <svg class="w-3.5 h-3.5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    SSH Key
                                </span>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-green-500/10 text-green-500 border border-green-500/20 flex items-center gap-1.5 w-max">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Healthy
                                </span>
                                <div class="text-[10px] text-accent mt-1">Updated 12 days ago</div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.credential-reveal id="cred_ssh" />
                            </x-ui.table.td>
                        </x-ui.table.tr>
                        <x-ui.table.tr class="hover:bg-accent/5 transition-colors">
                            <x-ui.table.td>
                                <div class="font-bold text-primary">App User</div>
                                <div class="text-[11px] text-accent mt-0.5">Limited deployment access</div>
                            </x-ui.table.td>
                            <x-ui.table.td><x-ui.copyable-text text="deployer" /></x-ui.table.td>
                            <x-ui.table.td class="font-mono text-xs"><x-ui.copyable-text text="2222" /></x-ui.table.td>
                            <x-ui.table.td>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs text-secondary font-medium">
                                    <svg class="w-3.5 h-3.5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    Password
                                </span>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-red-500/10 text-red-500 border border-red-500/20 flex items-center gap-1.5 w-max">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                    Needs Rotation
                                </span>
                                <div class="text-[10px] text-red-500/80 font-medium mt-1">94 days old</div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.credential-reveal id="cred_deployer" />
                            </x-ui.table.td>
                        </x-ui.table.tr>
                    </x-ui.table>
                </x-ui.card>
            </div>

            <!-- 3. APPLICATIONS TAB -->
            <div x-show="activeTab === 'applications'" style="display: none;" class="space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-primary">Hosted Applications</h3>
                        <p class="text-sm text-secondary mt-1">Manage workloads and websites running on this machine.</p>
                    </div>
                    <button @click="assignAppOpen = true" class="bg-primary text-surface px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Assign App
                    </button>
                </div>

                <x-ui.card class="bg-surface border border-accent/30 overflow-hidden p-0! shadow-sm">
                    <x-ui.table>
                        <x-slot name="header">
                            <tr class="bg-accent/5 border-b border-accent/30 text-xs text-secondary uppercase tracking-wider">
                                <x-ui.table.th class="border-r border-accent/10">Application Name</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Environment</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Domain / URL</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Tech Stack</x-ui.table.th>
                                <x-ui.table.th class="border-r border-accent/10">Status</x-ui.table.th>
                                <x-ui.table.th>Deployment Path</x-ui.table.th>
                            </tr>
                        </x-slot>
                        <x-ui.table.tr class="hover:bg-accent/5 transition-colors">
                            <x-ui.table.td>
                                <div class="font-bold text-primary">Main Landing Page</div>
                                <div class="text-[11px] text-accent mt-0.5">Customer facing website</div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-500/10 text-green-600 border border-green-600/20">Production</span>
                            </x-ui.table.td>
                            <x-ui.table.td><a href="#" class="text-blue-500 hover:underline text-sm font-medium">https://example.com</a></x-ui.table.td>
                            <x-ui.table.td>
                                <div class="flex gap-1.5">
                                    <x-ui.badge color="secondary">Next.js</x-ui.badge>
                                    <x-ui.badge color="secondary">Node</x-ui.badge>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2 py-1 rounded text-xs font-semibold bg-green-500/10 text-green-500 border border-green-500/20">Running</span>
                            </x-ui.table.td>
                            <x-ui.table.td class="font-mono text-xs">
                                <x-ui.copyable-text text="/var/www/html/landing-page" />
                            </x-ui.table.td>
                        </x-ui.table.tr>
                        <x-ui.table.tr class="hover:bg-accent/5 transition-colors">
                            <x-ui.table.td>
                                <div class="font-bold text-primary">Backend API</div>
                                <div class="text-[11px] text-accent mt-0.5">Core microservices</div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-orange-500/10 text-orange-500 border border-orange-500/20">Staging</span>
                            </x-ui.table.td>
                            <x-ui.table.td><a href="#" class="text-blue-500 hover:underline text-sm font-medium">api.example.com</a></x-ui.table.td>
                            <x-ui.table.td>
                                <div class="flex gap-1.5">
                                    <x-ui.badge color="secondary">Laravel</x-ui.badge>
                                    <x-ui.badge color="secondary">PHP 8.2</x-ui.badge>
                                </div>
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <span class="px-2 py-1 rounded text-xs font-semibold bg-green-500/10 text-green-500 border border-green-500/20">Running</span>
                            </x-ui.table.td>
                            <x-ui.table.td class="font-mono text-xs">
                                <x-ui.copyable-text text="/var/www/html/api" />
                            </x-ui.table.td>
                        </x-ui.table.tr>
                    </x-ui.table>
                </x-ui.card>
            </div>

            <!-- 4. MONITORING TAB (MOCKUP) -->
            <div x-show="activeTab === 'monitoring'" style="display: none;" class="space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-primary">Live Monitoring</h3>
                        <p class="text-sm text-secondary mt-1">Real-time resource utilization and application logs.</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-surface border border-accent/30 text-secondary px-3 py-1.5 rounded-lg text-sm font-medium hover:text-primary transition-colors flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Last 24 Hours
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.card class="bg-surface border border-accent/30 h-64 flex flex-col justify-center items-center text-secondary border-dashed">
                        <svg class="w-10 h-10 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
                        <p class="font-medium">CPU Usage Chart</p>
                        <p class="text-xs opacity-70">Chart.js integration goes here</p>
                    </x-ui.card>
                    <x-ui.card class="bg-surface border border-accent/30 h-64 flex flex-col justify-center items-center text-secondary border-dashed">
                        <svg class="w-10 h-10 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        <p class="font-medium">Memory Usage Chart</p>
                        <p class="text-xs opacity-70">Chart.js integration goes here</p>
                    </x-ui.card>
                </div>
                
                <x-ui.card class="bg-[#0D1117] border border-accent/30 p-0 overflow-hidden font-mono text-sm text-green-400">
                    <div class="px-4 py-2 border-b border-accent/20 bg-black/40 text-secondary text-xs flex justify-between">
                        <span>syslog - tail -f /var/log/syslog</span>
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                    <div class="p-4 space-y-1 h-48 overflow-y-auto">
                        <div><span class="text-secondary">[12:00:01]</span> systemd[1]: Started Docker Application Container Engine.</div>
                        <div><span class="text-secondary">[12:05:22]</span> CRON[1234]: (root) CMD ( /usr/local/bin/backup.sh )</div>
                        <div class="text-yellow-400"><span class="text-secondary">[12:15:00]</span> kernel: [  123.456] Warning: High memory usage detected on cgroup docker</div>
                        <div><span class="text-secondary">[12:20:11]</span> sshd[5678]: Accepted publickey for deployer from 10.0.1.55 port 55123 ssh2</div>
                        <div class="animate-pulse">_</div>
                    </div>
                </x-ui.card>
            </div>
        </div>

        <!-- Add Credential Slide-Over -->
        <x-ui.slide-over show="addCredentialOpen" title="Add New Credential" @close-credential-slide.window="addCredentialOpen = false">
            <x-slot name="icon">
                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </x-slot>

            <div>
                <x-ui.form.label>Type / Role</x-ui.form.label>
                <x-ui.form.input wire:model="cred_type" placeholder="e.g. Database User, Root, Deployer" />
                @error('cred_type') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Username</x-ui.form.label>
                <x-ui.form.input wire:model="cred_username" placeholder="root" />
                @error('cred_username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-ui.form.label>Port</x-ui.form.label>
                    <x-ui.form.input wire:model="cred_port" type="number" placeholder="22" />
                    @error('cred_port') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-ui.form.label>Auth Method</x-ui.form.label>
                    <select wire:model="cred_auth_method" class="w-full bg-surface border border-accent/30 rounded-md shadow-sm text-sm focus:border-primary focus:ring focus:ring-primary/20 py-2 px-3 text-primary mt-1">
                        <option value="">Select Method</option>
                        <option value="password">Password</option>
                        <option value="ssh_key">SSH Key</option>
                        <option value="token">Access Token</option>
                    </select>
                    @error('cred_auth_method') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <x-ui.form.label>Secret / Key</x-ui.form.label>
                <textarea wire:model="cred_secret" rows="4" class="w-full bg-surface border border-accent/30 rounded-md shadow-sm text-sm focus:border-primary focus:ring focus:ring-primary/20 p-3 text-primary font-mono placeholder:font-sans mt-1" placeholder="Enter password or paste private key..."></textarea>
                @error('cred_secret') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <x-slot name="footer">
                <button @click="addCredentialOpen = false" class="px-5 py-2 text-sm text-secondary hover:text-primary font-medium transition-colors focus:outline-none">Cancel</button>
                <button wire:click="saveCredential" wire:loading.attr="disabled" class="px-5 py-2 bg-primary text-surface rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-2 disabled:opacity-50 focus:outline-none">
                    <svg wire:loading wire:target="saveCredential" class="animate-spin h-4 w-4 text-surface" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display:none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Save Credential</span>
                </button>
            </x-slot>
        </x-ui.slide-over>

        <!-- Assign App Slide-Over -->
        <x-ui.slide-over show="assignAppOpen" title="Assign Application" @close-app-slide.window="assignAppOpen = false">
            <x-slot name="icon">
                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </x-slot>

            <div>
                <x-ui.form.label>Application Name</x-ui.form.label>
                <x-ui.form.input wire:model="app_name" placeholder="e.g. Main Landing Page" />
                @error('app_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Environment</x-ui.form.label>
                <select wire:model="app_environment" class="w-full bg-surface border border-accent/30 rounded-md shadow-sm text-sm focus:border-primary focus:ring focus:ring-primary/20 py-2 px-3 text-primary mt-1">
                    <option value="">Select Environment</option>
                    <option value="production">Production</option>
                    <option value="staging">Staging</option>
                    <option value="development">Development</option>
                    <option value="testing">Testing</option>
                </select>
                @error('app_environment') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Domain / URL</x-ui.form.label>
                <x-ui.form.input wire:model="app_domain" type="url" placeholder="https://example.com" />
                @error('app_domain') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Tech Stack</x-ui.form.label>
                <x-ui.form.input wire:model="app_tech_stack" placeholder="e.g. Laravel, Next.js, Node" />
                <p class="text-xs text-secondary mt-1">Separate multiple technologies with commas.</p>
                @error('app_tech_stack') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Deployment Path</x-ui.form.label>
                <x-ui.form.input wire:model="app_deployment_path" placeholder="/var/www/html/example" />
                @error('app_deployment_path') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-ui.form.label>Description</x-ui.form.label>
                <textarea wire:model="app_description" rows="3" class="w-full bg-surface border border-accent/30 rounded-md shadow-sm text-sm focus:border-primary focus:ring focus:ring-primary/20 p-3 text-primary mt-1" placeholder="Brief description of the application..."></textarea>
                @error('app_description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <x-slot name="footer">
                <button @click="assignAppOpen = false" class="px-5 py-2 text-sm text-secondary hover:text-primary font-medium transition-colors focus:outline-none">Cancel</button>
                <button wire:click="saveApp" wire:loading.attr="disabled" class="px-5 py-2 bg-primary text-surface rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-2 disabled:opacity-50 focus:outline-none">
                    <svg wire:loading wire:target="saveApp" class="animate-spin h-4 w-4 text-surface" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display:none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Assign App</span>
                </button>
            </x-slot>
        </x-ui.slide-over>
    </div>
@endsection
