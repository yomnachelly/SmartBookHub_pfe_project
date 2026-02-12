<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livre;
use App\Models\Commande;
use App\Mail\PasswordChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $currentMonth = now()->startOfMonth();
        
        $totalUsers = User::where('role', 'client')->count();
        $newUsersThisMonth = User::where('role', 'client')
            ->where('created_at', '>=', $currentMonth)
            ->count();
        
        $totalOrders = Commande::where('statut', '!=', 'panier')->count();
        $newOrdersThisMonth = Commande::where('statut', '!=', 'panier')
            ->where('created_at', '>=', $currentMonth)
            ->count();
        
        $totalRevenue = Commande::where('statut', 'validee')->sum('total') ?? 0;
        $revenueThisMonth = Commande::where('statut', 'validee')
            ->where('created_at', '>=', $currentMonth)
            ->sum('total') ?? 0;
        
        $totalBooks = Livre::count();
        $lowStockBooks = Livre::where('stock', '<', 5)->count();
        
        $totalStock = Livre::sum('stock');
        $maxStock = $totalBooks * 10;
        $stockPercentage = $maxStock > 0 ? ($totalStock / $maxStock) * 100 : 0;
        
        $booksSold = DB::table('commande_livre')->sum('quantite') ?? 0;
        $conversionRate = $totalUsers > 0 ? ($totalOrders / $totalUsers) * 100 : 0;
        
        $recentOrders = Commande::where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $recentClients = User::where('role', 'client')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $recentActivities = $this->getRecentActivities();
        
        $lowStockAlerts = Livre::where('stock', '<', 3)
            ->orderBy('stock', 'asc')
            ->take(3)
            ->get();
        
        return view('dashboard.employe', compact(
            'totalUsers',
            'newUsersThisMonth',
            'totalOrders',
            'newOrdersThisMonth',
            'totalRevenue',
            'revenueThisMonth',
            'totalBooks',
            'lowStockBooks',
            'stockPercentage',
            'booksSold',
            'conversionRate',
            'recentOrders',
            'recentClients',
            'recentActivities',
            'lowStockAlerts'
        ));
    }
    
    private function getRecentActivities()
    {
        $activities = [];
        
        $recentOrder = Commande::where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($recentOrder) {
            $activities[] = [
                'type' => 'success',
                'message' => 'Nouvelle commande #ORD-' . str_pad($recentOrder->id, 3, '0', STR_PAD_LEFT) . ' reçue',
                'time' => $recentOrder->created_at->diffForHumans()
            ];
        }
        
        $lowStockCount = Livre::where('stock', '<', 3)->count();
        if ($lowStockCount > 0) {
            $activities[] = [
                'type' => 'warning',
                'message' => $lowStockCount . ' livre(s) en stock bas',
                'time' => now()->subMinutes(rand(5, 60))->diffForHumans()
            ];
        }
        
        $recentUser = User::where('role', 'client')
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($recentUser && $recentUser->created_at->diffInHours() < 24) {
            $activities[] = [
                'type' => 'info',
                'message' => 'Nouvel utilisateur inscrit: ' . $recentUser->name,
                'time' => $recentUser->created_at->diffForHumans()
            ];
        }
        
        return $activities;
    }


    public function clientsIndex(Request $request)
    {
        $query = User::where('role', 'client');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        $clients = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('employe.clients.index', compact('clients'));
    }

    public function clientsShow(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $commandes = Commande::where('user_id', $client->id)
            ->where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalSpent = Commande::where('user_id', $client->id)
            ->where('statut', 'validee')
            ->sum('total');
        
        return view('employe.clients.show', compact('client', 'commandes', 'totalSpent'));
    }

    public function clientsEdit(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        return view('employe.clients.edit', compact('client'));
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
        
        $passwordChanged = false;
        
        if ($request->filled('password') && !empty($request->password)) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            
            $updateData['password'] = Hash::make($request->password);
            $passwordChanged = true;
            
            \Log::info('Password changed by employee for client: ' . $client->email);
        }
        
        $client->update($updateData);
        
        // email notification if password was changed
        if ($passwordChanged) {
            try {
                Mail::to($client->email)->send(new PasswordChangedNotification($client));
                \Log::info('Password change email sent to client: ' . $client->email);
            } catch (\Exception $e) {
                \Log::error('Failed to send password change email to ' . $client->email . ': ' . $e->getMessage());
                
                return redirect()->route('employe.clients.index')
                    ->with('success', 'Client modifié avec succès!')
                    ->with('warning', 'L\'email de confirmation n\'a pas pu être envoyé.');
            }
        }
        
        return redirect()->route('employe.clients.index')
            ->with('success', 'Client modifié avec succès!');
    }

    public function clientsToggleActive(User $client)
    {
        if ($client->role !== 'client') {
            abort(404);
        }
        
        $client->update([
            'is_active' => !$client->is_active,
        ]);
        
        return back()->with('success', 'Statut du client modifié avec succès!');
    }


    public function commandesIndex()
    {
        $commandes = Commande::where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('employe.commandes.index', compact('commandes'));
    }

    public function commandesShow(Commande $commande)
    {
        return view('employe.commandes.show', compact('commande'));
    }

    public function commandesValider(Request $request, Commande $commande)
    {
        $commande->update(['statut' => 'validee']);
        return back()->with('success', 'Commande validée avec succès!');
    }

    public function commandesAnnuler(Request $request, Commande $commande)
    {
        $commande->update(['statut' => 'annulee']);
        return back()->with('success', 'Commande annulée avec succès!');
    }
}