<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - InfraPortal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background flex items-center justify-center p-4 sm:p-8 font-sans text-primary">
    
    <div class="w-full max-w-[1000px] bg-surface rounded p-4 flex flex-col md:flex-row">
        
        <!-- Left Column - Branding (with margin inside the white card to match design) -->
        <div class="relative hidden md:flex flex-col justify-between w-1/2 p-6 rounded-md bg-primary overflow-hidden">
            <!-- Background image -->
            <img src="{{ asset('assets/images/login.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover z-0">
            <!-- Subtle glow/texture effect -->
            <div class="absolute -top-1/2 -right-1/2 w-full h-full bg-linear-gradient-to-b from-white/5 to-transparent rounded-full blur-3xl transform rotate-12 z-0"></div>
            
            <div class="relative z-10 flex items-center gap-2">
                <div class="w-3 h-3 bg-surface rounded-full"></div>
                <span class="font-bold text-md tracking-wide text-surface">InfraPortal</span>
            </div>

            <div class="relative z-10">
                <p class="text-accent text-sm">You can easily</p>
                <h1 class="text-surface font-bold text-3xl leading-tight">
                    Monitor, scale, and secure your infrastructure in real-time.
                </h1>
                <p class="text-accent/80 text-sm leading-relaxed max-w-sm">
                    Get full visibility into your servers, networks, and cloud deployments from a single, centralized dashboard.
                </p>
            </div>
        </div>

        <!-- Right Column - Form -->
        <div class="w-full md:w-1/2 px-10 py-12 flex flex-col justify-center gap-8">
            
            <div class="">
                <h2 class="text-3xl font-bold tracking-tight">Welcome back</h2>
                <p class="text-secondary text-sm">Enter your credentials to access your infrastructure console.</p>
            </div>

            <form action="#" method="POST" class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <x-form.input 
                        id="email" 
                        name="email" 
                        type="email" 
                        label="Work email" 
                        placeholder="name@company.com" 
                        required />

                    <x-form.password 
                        id="password" 
                        name="password" 
                        label="Password" 
                        required />
                </div>

                <div class="">
                    <x-button.primary>
                        Sign in to Portal
                    </x-button.primary>
                </div>
            </form>

            <div class="text-center">
                <p class="text-sm text-secondary">
                    forgetting your password? <a href="https://c.tenor.com/KFg7vQLunJkAAAAC/tenor.gif" class="hover:text-primary font-semibold transition-colors underline" target="_blank">so professional.</a>
                </p>
            </div>
            
        </div>
    </div>

</body>
</html>
