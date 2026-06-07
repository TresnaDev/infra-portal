@extends('layouts.app')

@section('content')
    <div class="w-full">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-primary mb-1">Good morning, Tresna 👋</h1>
            <p class="text-secondary text-sm">Here's a quick overview of your infrastructure health and system metrics today.</p>
        </div>

        <!-- Top Grid (5 columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
            <!-- Servers Widget -->
            <x-ui.card class="h-32 flex flex-col justify-center bg-surface border border-accent/10 p-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-secondary text-sm font-medium">Servers</span>
                    <div class="w-8 h-8 rounded bg-primary/5 flex items-center justify-center text-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-primary">12</h3>
                <p class="text-[10px] text-accent mt-1">2 clusters active</p>
            </x-ui.card>

            <!-- Credentials Widget -->
            <x-ui.card class="h-32 flex flex-col justify-center bg-surface border border-accent/10 p-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-secondary text-sm font-medium">Credentials</span>
                    <div class="w-8 h-8 rounded bg-primary/5 flex items-center justify-center text-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-primary">48</h3>
                <p class="text-[10px] text-accent mt-1">Stored securely</p>
            </x-ui.card>

            <!-- Cronjobs Widget -->
            <x-ui.card class="h-32 flex flex-col justify-center bg-surface border border-accent/10 p-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-secondary text-sm font-medium">Active Cronjobs</span>
                    <div class="w-8 h-8 rounded bg-primary/5 flex items-center justify-center text-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-primary">24</h3>
                <p class="text-[10px] text-accent mt-1">Running on agent</p>
            </x-ui.card>

            <!-- Backups Widget -->
            <x-ui.card class="h-32 flex flex-col justify-center bg-surface border border-accent/10 p-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-secondary text-sm font-medium">Backups Today</span>
                    <div class="w-8 h-8 rounded bg-primary/5 flex items-center justify-center text-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-primary">8</h3>
                <p class="text-[10px] text-accent mt-1">4.2 GB pulled to local</p>
            </x-ui.card>

            <!-- Alerts Widget -->
            <x-ui.card class="h-32 flex flex-col justify-center bg-red-50 border border-red-100 p-5">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-red-800 text-sm font-medium">Rotation Alerts</span>
                    <div class="w-8 h-8 rounded bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-red-600">3</h3>
                <p class="text-[10px] text-red-800/80 mt-1">Credentials expiring soon</p>
            </x-ui.card>
        </div>

        <!-- Bottom Grid (2 columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <x-ui.card class="bg-surface border border-accent/10 flex flex-col p-5">
                <h3 class="text-sm font-semibold text-primary mb-1">Cronjob Executions</h3>
                <p class="text-[10px] text-secondary mb-4">Success vs Failed jobs over the last 7 days</p>
                <x-ui.chart 
                    type="area" 
                    height="300" 
                    options="{
                        series: [{ name: 'Success', data: [120, 132, 115, 140, 145, 125, 138] }, { name: 'Failed', data: [2, 0, 5, 1, 0, 3, 1] }],
                        xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] },
                        colors: ['#363636', '#EF4444'],
                        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.05, stops: [0, 90, 100] } }
                    }" 
                />
            </x-ui.card>
            
            <x-ui.card class="bg-surface border border-accent/10 flex flex-col p-5">
                <h3 class="text-sm font-semibold text-primary mb-1">Backup Volume Pulled</h3>
                <p class="text-[10px] text-secondary mb-4">Total gigabytes downloaded from remote servers to local PC</p>
                <x-ui.chart 
                    type="bar" 
                    height="300" 
                    options="{
                        series: [{ name: 'Database Backups', data: [1.2, 1.5, 1.3, 2.1, 1.4, 2.8, 1.3] }, { name: 'File/Media Backups', data: [4.5, 4.8, 4.2, 5.1, 4.6, 6.2, 4.4] }],
                        xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] },
                        plotOptions: { bar: { borderRadius: 4, columnWidth: '40%', stacked: true } }
                    }" 
                />
            </x-ui.card>
        </div>
    </div>
@endsection