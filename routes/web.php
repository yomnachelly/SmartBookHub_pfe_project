<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Employee\BookController as EmployeeBookController;
use App\Http\Controllers\Employee\CategoryController as EmployeeCategoryController;

Route::get('/', [Controller::class, 'welcome'])->name('welcome');
Route::get('/book/{id}', [Controller::class, 'show'])->name('book.show');

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

// Employee routes
Route::middleware(['auth', RoleMiddleware::class . ':employee'])->prefix('employee')->name('employee.')->group(function () {
    // Books management
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [EmployeeBookController::class, 'index'])->name('index');
        Route::get('/creer', [EmployeeBookController::class, 'create'])->name('create');
        Route::post('/', [EmployeeBookController::class, 'store'])->name('store');
        Route::get('/{livre}/modifier', [EmployeeBookController::class, 'edit'])->name('edit');
        Route::put('/{livre}', [EmployeeBookController::class, 'update'])->name('update');
        Route::delete('/{livre}', [EmployeeBookController::class, 'destroy'])->name('destroy');
        Route::post('/{livre}/toggle-stock', [EmployeeBookController::class, 'toggleStock'])
            ->name('toggle-stock');
    });
    
    // Categories management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [EmployeeCategoryController::class, 'index'])->name('index');
        Route::get('/creer', [EmployeeCategoryController::class, 'create'])->name('create');
        Route::post('/', [EmployeeCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/modifier', [EmployeeCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [EmployeeCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [EmployeeCategoryController::class, 'destroy'])->name('destroy');
    });
});

// Admin routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])
        ->name('dashboard');
    
    // client toggle
    Route::post('/clients/{user}/toggle', [ClientController::class, 'toggle'])
        ->name('clients.toggle');
    
    // employees
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/create', [EmployeeController::class, 'create'])
            ->name('create');
        Route::post('/', [EmployeeController::class, 'store'])
            ->name('store');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])
            ->name('update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])
            ->name('destroy');
        Route::post('/{employee}/toggle', [EmployeeController::class, 'toggleActive'])
            ->name('toggle');
    });

    // books
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{livre}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{livre}', [BookController::class, 'update'])->name('update');
        Route::delete('/{livre}', [BookController::class, 'destroy'])->name('destroy');
        Route::post('/{livre}/toggle-stock', [BookController::class, 'toggleStock'])
            ->name('toggle-stock');
    });
    
    // categories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';