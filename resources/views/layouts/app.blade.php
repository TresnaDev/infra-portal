<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-background font-sans text-primary min-h-screen flex overflow-hidden" x-data="{ isSidebarOpen: true }">
    
    <!-- Sidebar Component -->
    <x-ui.sidebar />

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 h-screen transition-all duration-300">
        
        <!-- Navbar Component -->
        <x-ui.navbar />

        <!-- Page Content -->
        <main class="flex-1 px-4 sm:px-6 pb-6 overflow-y-auto mt-4">
            @yield('content')
            {{ $slot ?? '' }}
        </main>
        
    </div>

    @livewireScripts
</body>
</html>