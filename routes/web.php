<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Admin\UserManagement;

// Public routes
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', Login::class)->name('login');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', UserManagement::class)->name('admin.users');
    });
});