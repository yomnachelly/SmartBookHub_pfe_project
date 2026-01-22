<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Livre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PanierController extends Controller
{
    // Obtenir ou créer un panier
    private function getOrCreatePanier()
    {
        $session_id = session()->getId();
        
        if (Auth::check()) {
            // Utilisateur connecté: chercher par user_id
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
            // Visiteur: chercher par session_id
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
        
        return $panier;
    }
    
    // AJOUTER au panier
    public function ajouter($livre_id)
    {
        $livre = Livre::findOrFail($livre_id);
        
        // Vérifier le stock
        if ($livre->stock < 1) {
            return redirect()->back()->with('error', 'Ce livre est en rupture de stock.');
        }
        
        $panier = $this->getOrCreatePanier();
        
        // Vérifier si le livre est déjà dans le panier
        $existe = DB::table('commande_livre')
                   ->where('commande_id', $panier->id)
                   ->where('livre_id', $livre_id)
                   ->first();
        
        if ($existe) {
            // Augmenter la quantité
            DB::table('commande_livre')
                ->where('commande_id', $panier->id)
                ->where('livre_id', $livre_id)
                ->increment('quantite');
        } else {
            // Ajouter le livre
            DB::table('commande_livre')->insert([
                'commande_id' => $panier->id,
                'livre_id' => $livre_id,
                'quantite' => 1,
                'prix' => $livre->prix,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Mettre à jour le total du panier
        $this->updatePanierTotal($panier);
        
        return redirect()->back()->with('success', 'Livre ajouté au panier!');
    }
    
    // VOIR le panier
    public function index()
{
    $panier = $this->getOrCreatePanier();
    
    // Récupérer les livres du panier avec leurs détails COMPLETS
    $items = DB::table('commande_livre as cl')
              ->join('livres as l', 'cl.livre_id', '=', 'l.id_livre')
              ->where('cl.commande_id', $panier->id)
              ->select('l.*', 'cl.quantite', 'cl.prix as prix_unitaire')
              ->get()
              ->map(function($item) {
                  $item->sous_total = $item->quantite * $item->prix_unitaire;
                  // Ajouter l'ID du livre si nécessaire
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
    
    // METTRE À JOUR la quantité
    public function majQuantite(Request $request, $livre_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);
        
        $panier = $this->getOrCreatePanier();
        
        // Vérifier le stock disponible
        $livre = Livre::findOrFail($livre_id);
        if ($livre->stock < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant. Disponible: ' . $livre->stock);
        }
        
        DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->where('livre_id', $livre_id)
            ->update(['quantite' => $request->quantite]);
        
        $this->updatePanierTotal($panier);
        
        return redirect()->back()->with('success', 'Quantité mise à jour!');
    }
    
    // RETIRER du panier
    public function retirer($livre_id)
    {
        $panier = $this->getOrCreatePanier();
        
        DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->where('livre_id', $livre_id)
            ->delete();
        
        $this->updatePanierTotal($panier);
        
        return redirect()->back()->with('success', 'Livre retiré du panier!');
    }
    
    // VIDER le panier
    public function vider()
    {
        $panier = $this->getOrCreatePanier();
        
        DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->delete();
        
        $panier->update(['total' => 0]);
        
        return redirect()->route('panier.index')->with('success', 'Panier vidé!');
    }
    
    // Mettre à jour le total du panier
    private function updatePanierTotal($panier)
    {
        $total = DB::table('commande_livre')
                  ->where('commande_id', $panier->id)
                  ->selectRaw('SUM(quantite * prix) as total')
                  ->value('total') ?? 0;
        
        $panier->update(['total' => $total]);
    }
    
    // FORMULAIRE de validation de commande
    public function formulaireCommande()
    {
        $panier = $this->getOrCreatePanier();
        
        if ($panier->livres()->count() == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        // Pré-remplir avec les infos utilisateur si connecté
        $userData = [];
        if (Auth::check()) {
            $user = Auth::user();
            $userData = [
                'nom_client' => $user->name,
                'email' => $user->email,
                // Ajoutez d'autres champs si disponibles dans votre modèle User
            ];
        }
        
        return view('panier.formulaire', [
            'panier' => $panier,
            'userData' => $userData
        ]);
    }
    
    // VALIDER la commande
    public function validerCommande(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'mode_paiement' => 'required|in:ligne,sur_place',
        ]);
        
        $panier = $this->getOrCreatePanier();
        
        if ($panier->livres()->count() == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        // Vérifier les stocks avant validation
        foreach ($panier->livres as $livre) {
            $quantitePanier = $livre->pivot->quantite;
            if ($livre->stock < $quantitePanier) {
                return redirect()->back()->with('error', 
                    "Stock insuffisant pour '{$livre->titre}'. Disponible: {$livre->stock}");
            }
        }
        
        // Mettre à jour la commande avec les infos client
        $panier->update([
            'nom_client' => $request->nom_client,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'mode_paiement' => $request->mode_paiement,
            'statut' => 'en_attente'
        ]);
        
        // Mettre à jour user_id si l'utilisateur s'est connecté pendant le processus
        if (Auth::check() && !$panier->user_id) {
            $panier->update(['user_id' => Auth::id()]);
        }
        
        // Réduire les stocks
        foreach ($panier->livres as $livre) {
            $quantitePanier = $livre->pivot->quantite;
            $livre->decrement('stock', $quantitePanier);
        }
        
        // Créer une nouvelle commande panier pour les futurs achats
        if (Auth::check()) {
            Commande::create([
                'user_id' => Auth::id(),
                'session_id' => session()->getId(),
                'statut' => 'panier',
                'total' => 0
            ]);
        }
        
        return redirect()->route('commande.confirmation', $panier->id)
                        ->with('success', 'Commande passée avec succès!');
    }
}