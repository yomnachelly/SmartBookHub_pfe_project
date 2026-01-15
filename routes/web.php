<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware; // <- On inclut le middleware

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

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

// Dashboards spécifiques selon les rôles (sans Kernel)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->middleware(RoleMiddleware::class . ':admin')->name('admin.dashboard');

    Route::get('/employe/dashboard', function () {
        return view('dashboard.employe');
    })->middleware(RoleMiddleware::class . ':employe')->name('employe.dashboard');

    Route::get('/client/dashboard', function () {
        return view('dashboard.client');
    })->middleware(RoleMiddleware::class . ':client')->name('client.dashboard');
});

require __DIR__.'/auth.php';
