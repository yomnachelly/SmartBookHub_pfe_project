<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Employee\BookController as EmployeeBookController;
use App\Http\Controllers\Employee\CategoryController as EmployeeCategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\StripeController;

Route::get('/', [Controller::class, 'welcome'])->name('welcome');
Route::get('/book/{id}', [Controller::class, 'show'])->name('book.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/employe/dashboard', [EmployeeController::class, 'dashboard'])
        ->middleware(RoleMiddleware::class . ':employe')
        ->name('employe.dashboard');

    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])
        ->middleware(RoleMiddleware::class . ':client')
        ->name('client.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', function () {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    })->name('notifications.index');
    
    Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    });
    
    Route::post('/notifications/mark-all-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    })->name('notifications.mark-all-read');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.show');
    
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [AdminController::class, 'clientsIndex'])->name('index');
        Route::get('/{client}', [AdminController::class, 'clientsShow'])->name('show');
        Route::get('/{client}/edit', [AdminController::class, 'clientsEdit'])->name('edit');
        Route::put('/{client}', [AdminController::class, 'clientsUpdate'])->name('update');
        Route::post('/{user}/toggle', [AdminController::class, 'clientsToggle'])->name('toggle');
        Route::get('/create', [AdminController::class, 'clientsCreate'])->name('create');
        Route::post('/', [AdminController::class, 'clientsStore'])->name('store');
        Route::delete('/{client}', [AdminController::class, 'clientsDestroy'])->name('destroy');
    });
    
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [AdminController::class, 'employeesIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'employeesCreate'])->name('create');
        Route::post('/', [AdminController::class, 'employeesStore'])->name('store');
        Route::get('/{employee}/edit', [AdminController::class, 'employeesEdit'])->name('edit');
        Route::put('/{employee}', [AdminController::class, 'employeesUpdate'])->name('update');
        Route::delete('/{employee}', [AdminController::class, 'employeesDestroy'])->name('destroy');
        Route::post('/{employee}/toggle', [AdminController::class, 'employeesToggle'])->name('toggle');
        Route::get('/{employee}', [AdminController::class, 'employeesShow'])->name('show');
    });

    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{livre}/edit', [BookController::class, 'edit'])->name('edit');
        Route::get('/{livre}', [BookController::class, 'show'])->name('show');
        Route::put('/{livre}', [BookController::class, 'update'])->name('update');
        Route::delete('/{livre}', [BookController::class, 'destroy'])->name('destroy');
        Route::post('/{livre}/toggle-stock', [BookController::class, 'toggleStock'])
            ->name('toggle-stock');
        Route::post('/{livre}/toggle-visibility', [BookController::class, 'toggleVisibility'])
            ->name('toggle-visibility');
    });
    
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/', [CommandeController::class, 'indexAdmin'])->name('index');
        Route::get('/{id}', [CommandeController::class, 'showAdmin'])->name('show');
        Route::get('/{id}/edit', [CommandeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CommandeController::class, 'update'])->name('update');
        Route::post('/{id}/valider', [CommandeController::class, 'valider'])->name('valider');
        Route::post('/{id}/annuler', [CommandeController::class, 'annuler'])->name('annuler');
        Route::get('/{id}/download-facture', [CommandeController::class, 'downloadFacture'])
            ->name('downloadFacture');
        Route::post('/{id}/renvoyer-facture', [CommandeController::class, 'renvoyerFacture'])
            ->name('renvoyer.facture');
        Route::get('/{id}/preview-facture', [CommandeController::class, 'previewFacture'])
            ->name('preview.facture');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':employe'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [EmployeeBookController::class, 'index'])->name('index');
        Route::get('/creer', [EmployeeBookController::class, 'create'])->name('create');
        Route::post('/', [EmployeeBookController::class, 'store'])->name('store');
        Route::get('/{livre}/modifier', [EmployeeBookController::class, 'edit'])->name('edit');
        Route::get('/{livre}', [EmployeeBookController::class, 'show'])->name('show');
        Route::put('/{livre}', [EmployeeBookController::class, 'update'])->name('update');
        Route::delete('/{livre}', [EmployeeBookController::class, 'destroy'])->name('destroy');
        Route::post('/{livre}/toggle-stock', [EmployeeBookController::class, 'toggleStock'])
            ->name('toggle-stock');
    });
    
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [EmployeeCategoryController::class, 'index'])->name('index');
        Route::get('/creer', [EmployeeCategoryController::class, 'create'])->name('create');
        Route::post('/', [EmployeeCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/modifier', [EmployeeCategoryController::class, 'edit'])->name('edit');
        Route::get('/{category}', [EmployeeCategoryController::class, 'show'])->name('show');
        Route::put('/{category}', [EmployeeCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [EmployeeCategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':employe'])->prefix('employe')->name('employe.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    
    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/', [CommandeController::class, 'indexAdmin'])->name('index');
        Route::get('/{id}', [CommandeController::class, 'showAdmin'])->name('show');
        Route::get('/{id}/edit', [CommandeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CommandeController::class, 'update'])->name('update');
        Route::post('/{id}/valider', [CommandeController::class, 'valider'])->name('valider');
        Route::post('/{id}/annuler', [CommandeController::class, 'annuler'])->name('annuler');
        Route::get('/{id}/download-facture', [CommandeController::class, 'downloadFacture'])
            ->name('downloadFacture');
        Route::post('/{id}/renvoyer-facture', [CommandeController::class, 'renvoyerFacture'])
            ->name('renvoyer.facture');
        Route::get('/{id}/preview-facture', [CommandeController::class, 'previewFacture'])
            ->name('preview.facture');
    });
    
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [EmployeeController::class, 'clientsIndex'])->name('index');
        Route::get('/{client}', [EmployeeController::class, 'clientsShow'])->name('show');
        Route::get('/{client}/edit', [EmployeeController::class, 'clientsEdit'])->name('edit');
        Route::put('/{client}', [EmployeeController::class, 'clientsUpdate'])->name('update');
        Route::post('/{client}/toggle-active', [EmployeeController::class, 'clientsToggleActive'])->name('toggle-active');
        Route::get('/create', [EmployeeController::class, 'clientsCreate'])->name('create');
        Route::post('/', [EmployeeController::class, 'clientsStore'])->name('store');
        Route::delete('/{client}', [EmployeeController::class, 'clientsDestroy'])->name('destroy');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::put('/profile', [ClientController::class, 'updateProfile'])->name('profile.update');
    
    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/', [CommandeController::class, 'mesCommandes'])->name('index');
        Route::get('/{id}', [CommandeController::class, 'showClient'])->name('show');
        Route::post('/{id}/annuler', [CommandeController::class, 'annulerCommande'])->name('annuler');
        Route::get('/{id}/download-facture', [CommandeController::class, 'downloadFacture'])
            ->name('downloadFacture');
    });
});

// CART ROUTES
Route::prefix('panier')->name('panier.')->group(function () {
    Route::get('/', [PanierController::class, 'index'])->name('index');
    Route::post('/ajouter/{livre_id}', [PanierController::class, 'ajouter'])->name('ajouter');
    Route::delete('/retirer/{livre_id}', [PanierController::class, 'retirer'])->name('retirer');
    Route::put('/maj-quantite/{livre_id}', [PanierController::class, 'majQuantite'])->name('maj-quantite');
    Route::post('/vider', [PanierController::class, 'vider'])->name('vider');
    
    // ORDER FORM AND CHECKOUT
    Route::get('/formulaire', [PanierController::class, 'formulaireCommande'])->name('formulaire');
    Route::post('/valider-commande', [PanierController::class, 'validerCommande'])->name('valider-commande');
});

// ORDER CONFIRMATION
Route::get('/commande/confirmation/{id}', [PanierController::class, 'confirmation'])->name('commande.confirmation');

// PUBLIC INVOICE DOWNLOAD
Route::get('/commande/{id}/facture', [CommandeController::class, 'downloadFacturePublic'])->name('commande.facture');

// STRIPE PAYMENT ROUTES
Route::post('/stripe/checkout/{commande}', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// AUTHENTICATED USER ROUTES
Route::middleware(['auth'])->group(function () {
    // My orders section
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])->name('commandes.mes-commandes');
    Route::get('/mes-commandes/{id}', [CommandeController::class, 'showClient'])->name('commandes.show');
    
    // Invoice download
    Route::get('/mes-commandes/{id}/facture', [CommandeController::class, 'downloadFacture'])
        ->name('commandes.facture');
    Route::post('/mes-commandes/{id}/renvoyer-facture', [CommandeController::class, 'renvoyerFacture'])
        ->name('commandes.renvoyer.facture');
    
    // Wishlist routes
    Route::prefix('favoris')->name('client.wishlist.')->group(function () {
        Route::get('/', [ClientController::class, 'wishlist'])->name('index');
        Route::post('/ajouter/{livreId}', [ClientController::class, 'addToWishlist'])->name('add');
        Route::post('/retirer/{livreId}', [ClientController::class, 'removeFromWishlist'])->name('remove');
        Route::post('/vider', [ClientController::class, 'clearWishlist'])->name('clear');
    });
    
    Route::get('/mes-favoris', [ClientController::class, 'wishlist'])->name('client.wishlist');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [Controller::class, 'index'])->name('index');
    Route::get('/category/{category}', [Controller::class, 'byCategory'])->name('category');
    Route::get('/search', [Controller::class, 'search'])->name('search');
});

Route::get('/a-propos', function () {
    return view('apropos');
})->name('apropos');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

use Illuminate\Support\Facades\Auth;

Route::get('/login/admin', function () {
    return view('auth.login');
})->middleware('guest')->name('login.admin');

require __DIR__.'/auth.php';