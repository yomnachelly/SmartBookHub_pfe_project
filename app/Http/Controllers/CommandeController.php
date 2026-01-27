<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
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
use App\Mail\OrderConfirmationMail;

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
        
        try {
            Mail::to($commande->email)->send(new InvoiceMail($commande));
            \Log::info('Invoice sent for new order #' . $commande->id . ' to ' . $commande->email);
        } catch (\Exception $e) {
            \Log::error('Failed to send invoice for new order: ' . $e->getMessage());
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
            'success' => 'Commande passée avec succès! Un email de confirmation vous a été envoyé.',
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
            
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            
            $role = Auth::user()->role;
            
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
        try {
            $commande = Commande::findOrFail($id);
            
            if ($commande->statut === 'validee') {
                return redirect()->back()->with('info', 'Cette commande est déjà validée.');
            }
            
            $ancienStatut = $commande->statut;
            $commande->statut = 'validee';
            $commande->save();
            
            try {
                Mail::to($commande->email)->send(new InvoiceMail($commande));
                \Log::info('Invoice resent for validated order #' . $commande->id . ' to ' . $commande->email);
            } catch (\Exception $e) {
                \Log::error('Failed to send invoice for validated order: ' . $e->getMessage());
            }
            
            return redirect()->back()->with('success', 'Commande validée et facture envoyée au client');
            
        } catch (\Exception $e) {
            \Log::error('Failed to validate order: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur: ' . $e->getMessage());
        }
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
    
    public function downloadFacturePublic($id)
    {
        $commande = Commande::findOrFail($id);
        
        $canAccess = false;
        
        if (Auth::check() && $commande->user_id && $commande->user_id === Auth::id()) {
            $canAccess = true;
        }
        
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'employe')) {
            $canAccess = true;
        }
        
        if (!$canAccess && session('last_order_id') == $id && session('last_order_session') == session()->getId()) {
            $canAccess = true;
        }
        
        if (!$canAccess && !$commande->user_id && $commande->session_id === session()->getId()) {
            $canAccess = true;
        }
        
        if (!$canAccess) {
            abort(403, 'Unauthorized access to this invoice');
        }
        
        $commande->load('livres');
        
        $pdf = Pdf::loadView('invoices.invoice', compact('commande'));
        
        $fileName = 'facture-' . ($commande->reference ?? 'CMD-' . str_pad($commande->id, 6, '0', STR_PAD_LEFT)) . '.pdf';
        
        return $pdf->download($fileName);
    }
    
    public function renvoyerFacture($id)
    {
        $commande = Commande::findOrFail($id);
        
        if ($commande->statut !== 'validee') {
            return redirect()->back()->with('error', 'La facture n\'est disponible que pour les commandes validées.');
        }
        
        try {
            Mail::to($commande->email)->send(new InvoiceMail($commande));
            
            return redirect()->back()->with('success', 'Facture envoyée par email!');
        } catch (\Exception $e) {
            Log::error('Erreur envoi email facture: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi de la facture.');
        }
    }
    
    public function previewFacture($id)
    {
        $commande = Commande::findOrFail($id);
        
        if ($commande->statut !== 'validee') {
            return redirect()->back()->with('error', 'La facture n\'est disponible que pour les commandes validées.');
        }
        
        $pdf = Pdf::loadView('invoices.invoice', compact('commande'));
        
        return $pdf->stream('facture-' . $commande->reference . '.pdf');
    }
}