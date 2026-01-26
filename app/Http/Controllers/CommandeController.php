<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livre;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function panier()
    {
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if (!$panier) {
            return view('panier.index', [
                'items' => collect(),
                'total' => 0,
                'panierVide' => true,
                'panier' => null
            ]);
        }
        
        $items = DB::table('commande_livre as cl')
            ->join('livres as l', 'cl.livre_id', '=', 'l.id_livre')
            ->where('cl.commande_id', $panier->id)
            ->select('l.*', 'cl.quantite', 'cl.prix as prix_unitaire')
            ->get()
            ->map(function($item) {
                $item->sous_total = $item->quantite * $item->prix_unitaire;
                if (!isset($item->id_livre) && isset($item->id)) {
                    $item->id_livre = $item->id;
                }
                return $item;
            });
        
        $total = $items->sum('sous_total');
        
        return view('panier.index', [
            'items' => $items,
            'total' => $total,
            'panierVide' => $items->isEmpty(),
            'panier' => $panier
        ]);
    }
    
    public function ajouterAuPanier(Request $request, $livre_id)
    {
        $livre = Livre::findOrFail($livre_id);
        
        if ($livre->stock < 1) {
            return redirect()->back()->with('error', 'Ce livre est en rupture de stock.');
        }
        
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
            
            if (!$panier) {
                $panier = Commande::create([
                    'user_id' => Auth::id(),
                    'session_id' => $session_id,
                    'statut' => 'panier',
                    'total' => 0
                ]);
            }
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
            
            if (!$panier) {
                $panier = Commande::create([
                    'session_id' => $session_id,
                    'statut' => 'panier',
                    'total' => 0
                ]);
            }
        }
        
        $existe = DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->where('livre_id', $livre_id)
            ->first();
        
        if ($existe) {
            DB::table('commande_livre')
                ->where('commande_id', $panier->id)
                ->where('livre_id', $livre_id)
                ->increment('quantite');
        } else {
            DB::table('commande_livre')->insert([
                'commande_id' => $panier->id,
                'livre_id' => $livre_id,
                'quantite' => 1,
                'prix' => $livre->prix,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        $total = DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->selectRaw('SUM(quantite * prix) as total')
            ->value('total') ?? 0;
        
        $panier->update(['total' => $total]);
        
        return redirect()->back()->with('success', 'Livre ajouté au panier!');
    }
    
    public function retirerDuPanier($livre_id)
    {
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if ($panier) {
            DB::table('commande_livre')
                ->where('commande_id', $panier->id)
                ->where('livre_id', $livre_id)
                ->delete();
            
            $total = DB::table('commande_livre')
                ->where('commande_id', $panier->id)
                ->selectRaw('SUM(quantite * prix) as total')
                ->value('total') ?? 0;
            
            $panier->update(['total' => $total]);
        }
        
        return redirect()->route('panier.index')->with('success', 'Livre retiré du panier!');
    }
    
    public function majQuantite(Request $request, $livre_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);
        
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if (!$panier) {
            return redirect()->route('panier.index')->with('error', 'Panier non trouvé.');
        }
        
        $livre = Livre::findOrFail($livre_id);
        if ($livre->stock < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant. Disponible: ' . $livre->stock);
        }
        
        DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->where('livre_id', $livre_id)
            ->update(['quantite' => $request->quantite]);
        
        $total = DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->selectRaw('SUM(quantite * prix) as total')
            ->value('total') ?? 0;
        
        $panier->update(['total' => $total]);
        
        return redirect()->route('panier.index')->with('success', 'Quantité mise à jour!');
    }
    
    public function viderPanier()
    {
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if ($panier) {
            DB::table('commande_livre')
                ->where('commande_id', $panier->id)
                ->delete();
            
            $panier->update(['total' => 0]);
        }
        
        return redirect()->route('panier.index')->with('success', 'Panier vidé!');
    }
    
    public function formulaire()
    {
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if (!$panier || $panier->livres()->count() == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        $userData = [];
        if (Auth::check()) {
            $user = Auth::user();
            $userData = [
                'nom_client' => $user->name,
                'email' => $user->email,
            ];
        }
        
        return view('panier.formulaire', [
            'panier' => $panier,
            'userData' => $userData
        ]);
    }
    
    public function creerCommande(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'mode_paiement' => 'required|in:ligne,sur_place',
        ]);
        
        $session_id = session()->getId();
        $panier = null;
        
        if (Auth::check()) {
            $panier = Commande::where('user_id', Auth::id())
                ->where('statut', 'panier')
                ->first();
        } else {
            $panier = Commande::where('session_id', $session_id)
                ->where('statut', 'panier')
                ->first();
        }
        
        if (!$panier || $panier->livres()->count() == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        foreach ($panier->livres as $livre) {
            $quantitePanier = $livre->pivot->quantite;
            if ($livre->stock < $quantitePanier) {
                return redirect()->back()->with('error', 
                    "Stock insuffisant pour '{$livre->titre}'. Disponible: {$livre->stock}");
            }
        }
        
        $commande = $panier->replicate();
        $commande->statut = 'en_attente';
        $commande->nom_client = $request->nom_client;
        $commande->email = $request->email;
        $commande->telephone = $request->telephone;
        $commande->adresse = $request->adresse;
        $commande->mode_paiement = $request->mode_paiement;
        $commande->reference = 'CMD-' . strtoupper(Str::random(8));
        $commande->save();
        
        foreach ($panier->livres as $livre) {
            $commande->livres()->attach($livre->id_livre, [
                'quantite' => $livre->pivot->quantite,
                'prix' => $livre->pivot->prix
            ]);
        }
        
        foreach ($panier->livres as $livre) {
            $quantitePanier = $livre->pivot->quantite;
            $livre->decrement('stock', $quantitePanier);
        }
        
        if (Auth::check()) {
            $panier->delete();
            
            Commande::create([
                'user_id' => Auth::id(),
                'session_id' => session()->getId(),
                'statut' => 'panier',
                'total' => 0
            ]);
        } else {
            $panier->delete();
            
            Commande::create([
                'session_id' => session()->getId(),
                'statut' => 'panier',
                'total' => 0
            ]);
        }
        
        if ($request->mode_paiement == 'ligne') {
            return redirect()->route('stripe.checkout', $commande->id);
        }
        
        return redirect()->route('commande.confirmation')->with([
            'success' => 'Commande passée avec succès!',
            'commande_id' => $commande->id
        ]);
    }
    
    public function confirmation()
    {
        return view('commande.confirmation');
    }
    
    public function mesCommandes()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $commandes = Commande::where('user_id', Auth::id())
            ->where('statut', '!=', 'panier')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('client.commandes.index', compact('commandes'));
    }
    
    public function showClient($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $commande = Commande::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('client.commandes.show', compact('commande'));
    }
    
    public function annulerCommande($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $commande = Commande::where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('statut', ['en_attente', 'validee'])
            ->firstOrFail();
        
        foreach ($commande->livres as $livre) {
            $livre->increment('stock', $livre->pivot->quantite);
        }
        
        $commande->update(['statut' => 'annulee']);
        
        return redirect()->route('client.commandes.show', $commande->id)
            ->with('success', 'Commande annulée avec succès!');
    }
    
    public function indexAdmin()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            
            $commandes = Commande::where('statut', '!=', 'panier')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            // Determine which view to use based on user role
            $role = Auth::user()->role;
            
            if ($role === 'employe') {
                return view('employe.commandes.index', compact('commandes'));
            }
            
            return view('admin.commandes.index', compact('commandes'));
        } catch (\Exception $e) {
            \Log::error('Error in indexAdmin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors du chargement des commandes.');
        }
    }
    
    public function showAdmin($id)
    {
        try {
            $commande = Commande::findOrFail($id);
            
            // Determine which view to use based on user role
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            
            $role = Auth::user()->role;
            
            // Load relationships to avoid N+1 queries
            $commande->load('livres');
            
            if ($role === 'employe') {
                return view('employe.commandes.show', compact('commande'));
            }
            
            return view('admin.commandes.show', compact('commande'));
        } catch (\Exception $e) {
            \Log::error('Error in showAdmin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors du chargement de la commande.');
        }
    }
    
    public function showEmployee($id)
    {
        $commande = Commande::findOrFail($id);
        
        return view('employe.commandes.show', compact('commande'));
    }
    
    public function edit($id)
    {
        $commande = Commande::findOrFail($id);
        
        return view('admin.commandes.edit', compact('commande'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,validee,annulee,expediee,livree'
        ]);
        
        $commande = Commande::findOrFail($id);
        $ancienStatut = $commande->statut;
        $nouveauStatut = $request->statut;
        
        $commande->update(['statut' => $nouveauStatut]);
        
        if ($nouveauStatut === 'annulee' && $ancienStatut !== 'annulee') {
            foreach ($commande->livres as $livre) {
                $livre->increment('stock', $livre->pivot->quantite);
            }
        }
        
        if ($nouveauStatut === 'validee' && $ancienStatut === 'en_attente') {
            $user = User::find($commande->user_id);
            if ($user) {
                $user->notify(new \App\Notifications\CommandeValidee($commande));
            }
        }
        
        return redirect()->route('admin.commandes.show', $commande->id)
            ->with('success', 'Statut de la commande mis à jour!');
    }
    
    public function valider($id)
    {
        $commande = Commande::findOrFail($id);
        
        $commande->update(['statut' => 'validee']);
        
        $user = User::find($commande->user_id);
        if ($user) {
            $user->notify(new \App\Notifications\CommandeValidee($commande));
        }
        
        return redirect()->back()->with('success', 'Commande validée avec succès!');
    }
    
    public function annuler($id)
    {
        $commande = Commande::findOrFail($id);
        
        foreach ($commande->livres as $livre) {
            $livre->increment('stock', $livre->pivot->quantite);
        }
        
        $commande->update(['statut' => 'annulee']);
        
        return redirect()->back()->with('success', 'Commande annulée avec succès!');
    }
    
    public function downloadFacture($id)
    {
        $commande = Commande::findOrFail($id);
        
        // Check if order is validated
        if ($commande->statut !== 'validee') {
            return redirect()->back()->with('error', 'La facture n\'est disponible que pour les commandes validées.');
        }
        
        if (Auth::check()) {
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'employe') {
            } else if ($commande->user_id !== Auth::id()) {
                abort(403);
            }
        }
        
        $pdf = Pdf::loadView('invoices.invoice', compact('commande'));
        
        return $pdf->download('facture-' . $commande->reference . '.pdf');
    }
    
    public function renvoyerFacture($id)
    {
        $commande = Commande::findOrFail($id);
        
        // Check if order is validated
        if ($commande->statut !== 'validee') {
            return redirect()->back()->with('error', 'La facture n\'est disponible que pour les commandes validées.');
        }
        
        try {
            $pdf = Pdf::loadView('invoices.invoice', compact('commande'));
            
            Mail::send('emails.facture', ['commande' => $commande], function ($message) use ($commande, $pdf) {
                $message->to($commande->email)
                    ->subject('Votre facture - Commande ' . $commande->reference)
                    ->attachData($pdf->output(), 'facture-' . $commande->reference . '.pdf');
            });
            
            return redirect()->back()->with('success', 'Facture envoyée par email!');
        } catch (\Exception $e) {
            Log::error('Erreur envoi email facture: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi de la facture.');
        }
    }
    
    public function previewFacture($id)
    {
        $commande = Commande::findOrFail($id);
        
        // Check if order is validated
        if ($commande->statut !== 'validee') {
            return redirect()->back()->with('error', 'La facture n\'est disponible que pour les commandes validées.');
        }
        
        $pdf = Pdf::loadView('invoices.invoice', compact('commande'));
        
        return $pdf->stream('facture-' . $commande->reference . '.pdf');
    }
}