@extends('layouts.app')

@section('title', 'Add Server - Infra Portal')

@section('header')
    <h2 class="text-xl font-bold text-primary">Add Server</h2>
    <p class="text-sm text-secondary mt-1">Register a new server to the infrastructure management system.</p>
@endsection

@section('content')
    <div class="w-full space-y-6">
        <!-- Actions / Back -->
        <div class="flex items-center justify-between">
            <a href="{{ route('infrastructures.servers.index') }}" class="flex items-center gap-2 text-sm text-secondary hover:text-primary transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to Servers
            </a>
        </div>

        <form action="{{ route('infrastructures.servers.show', 1) }}" method="GET">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <x-ui.card class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-primary mb-4 border-b border-accent/30 pb-2">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-ui.form.label required>Server Name</x-ui.form.label>
                            <x-ui.form.input name="name" placeholder="e.g. App-Prod-01" required />
                        </div>
                        <div>
                            <x-ui.form.label>Tags / Labels</x-ui.form.label>
                            <x-ui.form.tags name="tags" :options="['app', 'database', 'storage', 'production', 'staging']" placeholder="Add labels..." />
                        </div>
                    </div>
                </x-ui.card>

                <!-- Network details -->
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-primary mb-4 border-b border-accent/30 pb-2">Network (IP Address)</h3>
                    <div class="space-y-4">
                        <div>
                            <x-ui.form.label required>VPC ID</x-ui.form.label>
                            <x-ui.form.input name="vpc_id" placeholder="e.g. vpc-1a2b3c" required />
                        </div>
                        <div>
                            <x-ui.form.label required>Private IP</x-ui.form.label>
                            <x-ui.form.input name="private_ip" placeholder="e.g. 10.0.1.10" required />
                        </div>
                        <div>
                            <x-ui.form.label>Public IP</x-ui.form.label>
                            <x-ui.form.input name="public_ip" placeholder="e.g. 203.0.113.10 (Optional)" />
                        </div>
                    </div>
                </x-ui.card>

                <!-- Specifications -->
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-primary mb-4 border-b border-accent/30 pb-2">Specifications</h3>
                    <div class="space-y-4">
                        <div>
                            <x-ui.form.label required>Operating System</x-ui.form.label>
                            <x-ui.form.input name="os" placeholder="e.g. Ubuntu 22.04" required />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-ui.form.label required>CPU Cores</x-ui.form.label>
                                <x-ui.form.input type="number" name="cpu_cores" placeholder="e.g. 8" required />
                            </div>
                            <div>
                                <x-ui.form.label required>RAM (GB)</x-ui.form.label>
                                <x-ui.form.input type="number" name="ram_gb" placeholder="e.g. 16" required />
                            </div>
                        </div>
                        <div>
                            <x-ui.form.label required>Storage / Disk</x-ui.form.label>
                            <x-ui.form.input name="disk" placeholder="e.g. 250GB NVMe" required />
                        </div>
                    </div>
                </x-ui.card>

                <!-- Placement & Administration -->
                <x-ui.card class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-primary mb-4 border-b border-accent/30 pb-2">Placement & Administration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <x-ui.form.label required>Location Group</x-ui.form.label>
                                <x-ui.form.select name="location_group" required>
                                    <option value="" disabled selected>Select Provider/Location</option>
                                    <option value="aws">AWS (Amazon Web Services)</option>
                                    <option value="gcp">GCP (Google Cloud)</option>
                                    <option value="niagahoster">Niagahoster/Hostinger</option>
                                    <option value="idcloudhost">IDCloudHost</option>
                                    <option value="biznetgio">Biznet Gio</option>
                                    <option value="on-premise">On-Premise (Local)</option>
                                </x-ui.form.select>
                            </div>
                            <div>
                                <x-ui.form.label required>Location Detail / Region</x-ui.form.label>
                                <x-ui.form.input name="location_detail" placeholder="e.g. ap-southeast-1 or Jakarta Duren Tiga" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <x-ui.form.label required>Administrator / PIC</x-ui.form.label>
                                <x-ui.form.input name="administrator" placeholder="e.g. Bizdev Team" required/>
                            </div>
                            <div>
                                <x-ui.form.label>Notes / Description</x-ui.form.label>
                                <x-ui.form.textarea name="description" placeholder="Additional details about this server..."></x-ui.form.textarea>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <!-- Submit actions -->
            <div class="mt-6 flex items-center justify-end gap-4">
                <a href="{{ route('infrastructures.servers.index') }}" class="px-6 py-2.5 text-sm text-secondary hover:text-primary transition-colors focus:outline-none">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-surface rounded-md text-sm font-semibold shadow hover:bg-primary/90 transition-colors flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-surface">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Save Server
                </button>
            </div>
        </form>
    </div>
@endsection
