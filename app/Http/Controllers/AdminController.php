<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livre;
use App\Models\Commande;
use App\Mail\EmployeeCredentialsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        // stats
        $totalClients = User::where('role', 'client')->count();
        $totalEmployees = User::where('role', 'employe')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalOrders = Commande::where('statut', '!=', 'panier')->count();
        $totalRevenue = Commande::where('statut', 'validee')->sum('total') ?? 0;
        $totalBooks = Livre::count();
        
        $lastMonthClients = User::where('role', 'client')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        $lastMonthOrders = Commande::where('statut', '!=', 'panier')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        $lastMonthRevenue = Commande::where('statut', 'validee')
            ->where('created_at', '>=', now()->subDays(30))
            ->sum('total') ?? 0;
        
        $lowStockBooks = Livre::where('stock', '<', 10)->count();
        
        $employees = User::where('role', 'employe')->orderBy('created_at', 'desc')->get();
        $clients = User::where('role', 'client')->orderBy('created_at', 'desc')->take(10)->get();
        
        // fetching orders
        $recentOrders = Commande::where('statut', '!=', 'panier')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard.admin', compact(
            'totalClients', 
            'totalEmployees', 
            'totalAdmins', 
            'totalOrders', 
            'totalRevenue', 
            'totalBooks',
            'lastMonthClients',
            'lastMonthOrders',
            'lastMonthRevenue',
            'lowStockBooks',
            'employees',
            'clients',
            'recentOrders'
        ));
    }

    // ------------------- EMPLOYEE MANAGEMENT -------------------

    public function employeesIndex()
    {
        $employees = User::where('role', 'employe')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.employees.index', compact('employees'));
    }

    public function employeesCreate()
    {
        return view('admin.employees.create');
    }

    public function employeesStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Stocker le mot de passe en clair temporairement pour l'email
        $plainPassword = $request->password;

        // créer l'employé
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'role' => 'employe',
            'is_active' => true,
        ]);

        // envoi d'email avec les identifiants (employé)
        try {
            Mail::to($employee->email)->send(new EmployeeCredentialsMail($employee, $plainPassword));
            Log::info('Employee credentials email sent to: ' . $employee->email);
            
            return redirect()->route('admin.employees.index')
                ->with('success', 'Employé créé avec succès ! Un email avec les identifiants a été envoyé à ' . $employee->email);
        } catch (\Exception $e) {
            Log::error('Failed to send employee credentials email: ' . $e->getMessage());
            
            return redirect()->route('admin.employees.index')
                ->with('warning', 'Employé créé avec succès, mais l\'email n\'a pas pu être envoyé. Veuillez communiquer les identifiants manuellement.');
        }
    }

    public function employeesEdit(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(404);
        }
        
        return view('admin.employees.edit', compact('employee'));
    }

    public function employeesUpdate(Request $request, User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(404);
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $employee->id],
            'is_active' => ['required', 'in:0,1'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => (int)$request->is_active === 1,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => [Rules\Password::defaults()],
            ]);
            $updateData['password'] = Hash::make($request->password);
        }

        $employee->update($updateData);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employé modifié avec succès!');
    }

    public function employeesToggle(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(404);
        }
        
        $employee->update([
            'is_active' => !$employee->is_active,
        ]);

        return back()->with('success', 'Statut de l\'employé modifié avec succès!');
    }

    // ------------------- CLIENT MANAGEMENT -------------------

    public function clientsIndex()
    {
        $clients = User::where('role', 'client')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $newClientsCount = User::where('role', 'client')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        return view('admin.clients.index', compact('clients', 'newClientsCount'));
    }

    public function clientsToggle(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $client->update([
            'is_active' => !$client->is_active,
        ]);

        return back()->with('success', 'Statut du client modifié avec succès!');
    }

    public function clientsShow(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $orders = Commande::where('user_id', $client->id)
            ->where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $totalSpent = Commande::where('user_id', $client->id)
            ->where('statut', 'validee')
            ->sum('total') ?? 0;
        
        $completedOrders = Commande::where('user_id', $client->id)
            ->where('statut', 'validee')
            ->count();
        $averageOrderValue = $completedOrders > 0 ? $totalSpent / $completedOrders : 0;
        
        return view('admin.clients.show', compact('client', 'orders', 'totalSpent', 'averageOrderValue'));
    }

    public function clientsEdit(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        return view('admin.clients.edit', compact('client'));
    }

    public function clientsUpdate(Request $request, User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $client->id],
            'is_active' => ['required', 'in:0,1'],
        ]);
        
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => (int)$request->is_active === 1,
        ];
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => [Rules\Password::defaults()],
            ]);
            $updateData['password'] = Hash::make($request->password);
        }
        
        $client->update($updateData);
        
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client modifié avec succès!');
    }

    public function clientsDestroy(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $hasOrders = Commande::where('user_id', $client->id)->exists();
        
        if ($hasOrders) {
            return back()->with('error', 'Impossible de supprimer ce client car il a des commandes!');
        }
        
        $client->delete();
        
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client supprimé avec succès!');
    }

    public function employeesDestroy(User $employee)
    {
        if ($employee->role !== 'employe') {
            abort(404);
        }
        
        // preventing admin from deleting themselves
        if ($employee->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte!');
        }
        
        $employee->delete();
        
        return redirect()->route('admin.employees.index')
            ->with('success', 'Employé supprimé avec succès!');
    }
}