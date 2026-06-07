<aside 
    class="w-72 p-4 ml-4 mr-0 bg-surface flex flex-col transition-all duration-300 ease-in-out shrink-0 overflow-y-auto my-4 rounded-md"
    style="height: calc(100vh - 2rem);"
    :class="{'w-72 p-4 ml-4 mr-0': isSidebarOpen, 'w-0 p-0 overflow-hidden ml-0! my-0! h-0!': !isSidebarOpen}">
    
    <!-- Branding Card -->
    <div class="opacity-100 relative flex flex-col justify-center w-full p-6 rounded-md bg-primary overflow-hidden mb-8 transition-opacity duration-300"
         :class="{'opacity-100': isSidebarOpen, 'opacity-0 hidden': !isSidebarOpen}">
        <!-- Background image -->
        <img src="{{ asset('assets/images/login.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover z-0">
        <!-- Subtle glow/texture effect over image -->
        <div class="absolute inset-0 bg-linear-to-b from-transparent to-black/50 z-0"></div>
        
        <div class="relative z-10 flex items-center gap-2 mb-2">
            <div class="w-2.5 h-2.5 bg-surface rounded-full"></div>
            <span class="font-bold text-sm tracking-wide text-surface">InfraPortal</span>
        </div>
        <p class="relative z-10 text-accent/80 text-xs leading-relaxed max-w-[200px]">
            Centralized control for your entire digital ecosystem.
        </p>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex flex-col gap-6" x-show="isSidebarOpen" x-transition.opacity.duration.300ms>
        
        <!-- Menu Group -->
        <div>
            <h3 class="text-[10px] font-bold text-accent uppercase tracking-wider mb-3 px-2">Main Menu</h3>
            <ul class="flex flex-col gap-1">
                <li>
                    <a href="#" class="flex items-center justify-between px-2 py-2 rounded-md bg-accent/10 text-primary font-medium hover:bg-accent/20 transition-colors">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-sm">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-2 py-2 rounded-md text-secondary hover:bg-accent/10 hover:text-primary transition-colors group focus:outline-none">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 transition-colors" :class="expanded ? 'text-primary' : 'text-secondary group-hover:text-primary'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                            <span class="text-sm" :class="expanded ? 'text-primary font-medium' : ''">Infrastructure</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="expanded ? 'rotate-90 text-primary' : 'text-accent group-hover:text-primary'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Submenu -->
                    <ul x-show="expanded" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="mt-1 flex flex-col gap-1 pl-10 pr-2"
                        style="display: none;">
                        <li>
                            <a href="{{ route('infrastructures.servers.index') }}" class="block px-2 py-1.5 rounded-md text-sm text-secondary hover:text-primary hover:bg-accent/10 transition-colors">Servers</a>
                        </li>
                        <li>
                            <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-secondary hover:text-primary hover:bg-accent/10 transition-colors">Credentials</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-between px-2 py-2 rounded-md text-secondary hover:bg-accent/10 hover:text-primary transition-colors group">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-secondary group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm">Cronjobs</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-between px-2 py-2 rounded-md text-secondary hover:bg-accent/10 hover:text-primary transition-colors group">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-secondary group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            <span class="text-sm">Backups</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Secondary Menu Group -->
        <div>
            <h3 class="text-[10px] font-bold text-accent uppercase tracking-wider mb-3 px-2">Main Menu</h3>
            <ul class="flex flex-col gap-1">
                <li>
                    <a href="#" class="flex items-center justify-between px-2 py-2 rounded-md text-secondary hover:bg-accent/10 hover:text-primary transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-secondary group-hover:bg-primary transition-colors"></div>
                            </div>
                            <span class="text-sm">Menu Item</span>
                        </div>
                        <svg class="w-4 h-4 text-accent group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <h3 class="text-[10px] font-bold text-accent uppercase tracking-wider mb-3 px-2">Settings</h3>
            <ul class="flex flex-col gap-1">
                <li>
                    <a href="#" class="flex items-center justify-between px-2 py-2 rounded-md text-secondary hover:bg-accent/10 hover:text-primary transition-colors group">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-secondary group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-sm">Agent Connections</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Footer / Copyright -->
    <div class="mt-auto pt-8 px-2 pb-2 mb-2" x-show="isSidebarOpen" x-transition.opacity.duration.300ms>
        <div class="flex items-center justify-center border-t border-accent/20 pt-4">
            <p class="text-[10px] text-accent text-center leading-relaxed">
                &copy; {{ date('Y') }} InfraPortal.<br>
                Developed by <a href="https://c.tenor.com/e-FcSL2SPSYAAAAd/tenor.gif" class="font-semibold text-secondary hover:text-primary transition-colors">SleepyDev</a>
            </p>
        </div>
    </div>
</aside>
