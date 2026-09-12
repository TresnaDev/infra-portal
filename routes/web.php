<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

// Infrastructure Management
Route::prefix('infrastructures')->name('infrastructures.')->group(function () {

    // Server Management
    Route::prefix('servers')->name('servers.')->group(function () {

        // Dummy data for simulation
        $getServers = function () {
            return collect([
                [
                    'id' => 1,
                    'name' => 'App-Prod-01',
                    'vpc_id' => 'vpc-1a2b3c',
                    'private_ip' => '10.0.1.10',
                    'public_ip' => '203.0.113.10',
                    'os' => 'Ubuntu 22.04 LTS',
                    'cpu_cores' => 8,
                    'ram_gb' => 16,
                    'disk' => '250GB NVMe SSD',
                    'location_group' => 'aws',
                    'location_detail' => 'ap-southeast-1 (Jakarta)',
                    'administrator' => 'Bizdev Team',
                    'description' => 'Main application server for user portal. Requires high availability.',
                    'tags' => ['app', 'production'],
                    'status' => 'running',
                    'uptime' => '45 days, 12 hrs',
                    'keys_count' => 2,
                    'apps_count' => 3,
                ],
                [
                    'id' => 2,
                    'name' => 'Db-Master-01',
                    'vpc_id' => 'vpc-1a2b3c',
                    'private_ip' => '10.0.1.50',
                    'public_ip' => '-',
                    'os' => 'Debian 12',
                    'cpu_cores' => 16,
                    'ram_gb' => 64,
                    'disk' => '1TB SSD',
                    'location_group' => 'on-premise',
                    'location_detail' => 'Jakarta, Duren Tiga - 02',
                    'administrator' => 'Pak Dewa',
                    'description' => 'Primary database master server.',
                    'tags' => ['database', 'production'],
                    'status' => 'running',
                    'uptime' => '120 days, 5 hrs',
                    'keys_count' => 1,
                    'apps_count' => 1,
                ],
                [
                    'id' => 3,
                    'name' => 'Worker-Queue-01',
                    'vpc_id' => 'vpc-9z8y7x',
                    'private_ip' => '10.0.2.15',
                    'public_ip' => '-',
                    'os' => 'Ubuntu 22.04',
                    'cpu_cores' => 4,
                    'ram_gb' => 8,
                    'disk' => '100GB SSD',
                    'location_group' => 'niagahoster',
                    'location_detail' => 'Singapore Region',
                    'administrator' => 'Pak Agung',
                    'description' => 'Background job worker server.',
                    'tags' => ['app', 'staging'],
                    'status' => 'running',
                    'uptime' => '12 days, 2 hrs',
                    'keys_count' => 1,
                    'apps_count' => 0,
                ],
            ]);
        };

        Route::get('/', function () use ($getServers) {
            $servers = $getServers();
            // Convert arrays to objects for consistent attribute access
            $servers = $servers->map(fn($s) => (object) $s);
            return view('pages.infrastructures.servers.server-index', compact('servers'));
        })->name('index');

        Route::get('/create', function () {
            return view('pages.infrastructures.servers.server-create');
        })->name('create');

        Route::get('/{id}', function ($id) use ($getServers) {
            $server = $getServers()->firstWhere('id', (int) $id);
            if (!$server) {
                abort(404);
            }
            $server = (object) $server;
            return view('pages.infrastructures.servers.server-detail', compact('server'));
        })->name('show');

        Route::get('/{id}/edit', function ($id) use ($getServers) {
            $server = $getServers()->firstWhere('id', (int) $id);
            if (!$server) {
                abort(404);
            }
            $server = (object) $server;
            return view('pages.infrastructures.servers.server-edit', compact('server'));
        })->name('edit');

        Route::put('/{id}', function ($id) {
            return redirect()->route('infrastructures.servers.show', $id)
                ->with('success', 'Server updated successfully');
        })->name('update');
    });
});
