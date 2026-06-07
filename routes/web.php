<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/infrastructures/servers', function () {
    return view('pages.infrastructures.servers.server-index');
})->name('infrastructures.servers.index');
Route::get('/infrastructures/servers/create', function () {
    return view('pages.infrastructures.servers.server-create');
})->name('infrastructures.servers.create');


Route::get('/infrastructures/servers/{id}', function ($id) {
    return view('pages.infrastructures.servers.server-detail');
})->name('infrastructures.servers.show');

