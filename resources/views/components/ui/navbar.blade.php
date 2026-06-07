<header class="bg-surface h-16 flex items-center justify-between px-4 sm:px-6 mb-4 rounded-md mx-4 sm:mx-6 mt-4">
    <!-- Left: Sidebar Toggle -->
    <button @click="isSidebarOpen = !isSidebarOpen" class="w-10 h-10 rounded-md bg-accent/20 flex items-center justify-center text-primary hover:bg-accent/30 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>

    <!-- Right: Notifications & Profile -->
    <div class="flex items-center gap-4">
        
        <!-- Notifications Dropdown -->
        <x-ui.dropdown align="right" width="w-80">
            <x-slot name="trigger">
                <button class="relative p-2 text-secondary hover:text-primary transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <!-- Notification Badge -->
                    <span class="absolute top-1 right-2 flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 py-3 border-b border-accent/10 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-primary">Notifications</h3>
                    <button class="text-xs text-secondary hover:text-primary underline">Mark all as read</button>
                </div>
                <div class="max-h-60 overflow-y-auto">
                    <!-- Notification Item -->
                    <div class="px-4 py-3 hover:bg-accent/5 transition-colors border-b border-accent/5">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-sm text-primary font-medium">Server CPU High</p>
                                <p class="text-xs text-secondary mt-0.5">App-Server-01 is above 90% utilization.</p>
                                <p class="text-[10px] text-accent mt-1">2 mins ago</p>
                            </div>
                            <button class="text-xs text-primary bg-accent/20 px-2 py-1 rounded hover:bg-accent/30 whitespace-nowrap">Mark Read</button>
                        </div>
                    </div>
                    <!-- Notification Item -->
                    <div class="px-4 py-3 hover:bg-accent/5 transition-colors">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-sm text-primary font-medium">Database Backup</p>
                                <p class="text-xs text-secondary mt-0.5">Daily backup completed successfully.</p>
                                <p class="text-[10px] text-accent mt-1">1 hour ago</p>
                            </div>
                            <button class="text-xs text-primary bg-accent/20 px-2 py-1 rounded hover:bg-accent/30 whitespace-nowrap">Mark Read</button>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 border-t border-accent/10 text-center">
                    <a href="#" class="text-xs text-primary font-medium hover:underline">View all notifications</a>
                </div>
            </x-slot>
        </x-ui.dropdown>

        <!-- Profile Dropdown -->
        <x-ui.dropdown align="right" width="w-48">
            <x-slot name="trigger">
                <button class="flex items-center gap-3 focus:outline-none group">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-surface text-sm font-bold overflow-hidden">
                        <!-- Using an avatar placeholder -->
                        <img src="https://ui-avatars.com/api/?name=Tresna+Agustina&background=0C0C0C&color=f9f9f9" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div class="text-left hidden md:block">
                        <p class="text-sm font-semibold text-primary leading-tight">Tresna Agustina</p>
                        <p class="text-[10px] text-secondary">Super Admin</p>
                    </div>
                    <svg class="w-4 h-4 text-secondary group-hover:text-primary transition-colors hidden md:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="py-1">
                    <a href="#" class="block px-4 py-2 text-sm text-secondary hover:bg-accent/10 hover:text-primary transition-colors">My Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-secondary hover:bg-accent/10 hover:text-primary transition-colors">Settings</a>
                    <div class="border-t border-accent/10 my-1"></div>
                    <form method="POST" action="#">
                        <!-- @csrf -->
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </x-slot>
        </x-ui.dropdown>
        
    </div>
</header>
