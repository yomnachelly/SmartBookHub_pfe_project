<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard générique (accessible après authentification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes liées au profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboards spécifiques selon les rôles
Route::middleware(['auth'])->group(function () {
    Route::get('/employe/dashboard', function () {
        return view('dashboard.employe');
    })->middleware(RoleMiddleware::class . ':employe')->name('employe.dashboard');

    Route::get('/client/dashboard', function () {
        return view('dashboard.client');
    })->middleware(RoleMiddleware::class . ':client')->name('client.dashboard');
});

// Admin routes group
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [EmployeeController::class, 'index'])
        ->name('admin.dashboard');
    
    // Client toggle route
    Route::post('/clients/{user}/toggle', [ClientController::class, 'toggle'])
        ->name('admin.clients.toggle');
    
    // Employee management routes
    Route::prefix('employees')->group(function () {
        Route::get('/create', [EmployeeController::class, 'create'])
            ->name('admin.employees.create');
        Route::post('/', [EmployeeController::class, 'store'])
            ->name('admin.employees.store');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('admin.employees.edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])
            ->name('admin.employees.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])
            ->name('admin.employees.destroy');
        Route::post('/{employee}/toggle', [EmployeeController::class, 'toggleActive'])
            ->name('admin.employees.toggle');
    });
});

require __DIR__.'/auth.php';