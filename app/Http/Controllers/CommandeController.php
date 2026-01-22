<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Livre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CommandeController extends Controller
{
     // ================= PANIER (SESSION POUR TOUS) =================
    
    private function getPanierSession()
    {
        return Session::get('panier', []);
    }
    
    private function savePanierSession($panier)
    {
        Session::put('panier', $panier);
        Session::save();
    }
    
    public function ajouterAuPanier($livre_id)
    {
        $livre = Livre::findOrFail($livre_id);
        $panier = $this->getPanierSession();
        
        // Vérifier si le livre existe déjà dans le panier
        if (isset($panier[$livre_id])) {
            $panier[$livre_id]['quantite'] += 1;
        } else {
            $panier[$livre_id] = [
                'livre_id' => $livre_id,
                'quantite' => 1,
                'prix' => $livre->prix,
                'titre' => $livre->titre,
                'auteur' => $livre->auteur,
                'image' => $livre->image
            ];
        }
        
        $this->savePanierSession($panier);
        
        return redirect()->back()->with('success', 'Livre ajouté au panier!');
    }
    
    // REMPLACER CETTE MÉTHODE PAR LA NOUVELLE VERSION :
    public function panier()
    {
        $panier = $this->getPanierSession();
        $items = [];
        $total = 0;
        
        if (!empty($panier)) {
            // Récupérer tous les livres en une seule requête
            $livreIds = array_column($panier, 'livre_id');
            $livres = Livre::whereIn('id_livre', $livreIds)
                ->select('id_livre', 'stock')
                ->get()
                ->keyBy('id_livre');
            
            foreach ($panier as $item) {
                $livreStock = $livres[$item['livre_id']]->stock ?? 0;
                
                $sousTotal = $item['quantite'] * $item['prix'];
                $total += $sousTotal;
                
                $items[] = (object) [
                    'id_livre' => $item['livre_id'],
                    'titre' => $item['titre'],
                    'auteur' => $item['auteur'],
                    'prix' => $item['prix'],
                    'image' => $item['image'],
                    'quantite' => $item['quantite'],
                    'sous_total' => $sousTotal,
                    'stock' => $livreStock // Ajouter le stock
                ];
            }
        }
        
        return view('panier.index', [
            'items' => collect($items),
            'total' => $total,
            'panierVide' => empty($panier)
        ]);
    }
    
    // ================= GESTION PANIER =================
    
  public function retirerDuPanier($livre_id)
    {
        $panier = $this->getPanierSession();
        
        if (isset($panier[$livre_id])) {
            unset($panier[$livre_id]);
            $this->savePanierSession($panier);
        }
        
        return redirect()->route('panier.index')->with('success', 'Livre retiré du panier!');
    }
    
    public function majQuantite(Request $request, $livre_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);
        
        $panier = $this->getPanierSession();
        
        if (isset($panier[$livre_id])) {
            $panier[$livre_id]['quantite'] = $request->quantite;
            $this->savePanierSession($panier);
        }
        
        return redirect()->route('panier.index')->with('success', 'Quantité mise à jour!');
    }
    
    // ================= VALIDATION COMMANDE =================
    
    public function validerCommande(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
        ]);
        
        $panier = $this->getPanierSession();
        
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        // Calculer le total
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['quantite'] * $item['prix'];
        }
        
        // Créer la commande
        $commande = Commande::create([
            'user_id' => Auth::id(), // null si visiteur
            'nom_client' => $request->nom_client,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'total' => $total,
            'statut' => 'en_attente'
        ]);
        
        // Ajouter les livres à la commande
        foreach ($panier as $item) {
            DB::table('commande_livre')->insert([
                'commande_id' => $commande->id,
                'livre_id' => $item['livre_id'],
                'quantite' => $item['quantite'],
                'prix' => $item['prix'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Vider le panier session
        $this->savePanierSession([]);
        
        // Stocker l'ID de commande pour la page de confirmation
        Session::put('derniere_commande_id', $commande->id);
        
        return redirect()->route('commande.confirmation')->with('success', 'Commande passée avec succès!');
    }
    
    public function confirmation()
    {
        $commandeId = Session::get('derniere_commande_id');
        $commande = $commandeId ? Commande::find($commandeId) : null;
        
        return view('commande.confirmation', compact('commande'));
    }
    
    // ================= RESTE DU CODE (ADMIN/EMPLOYÉ) =================
    
    public function indexAdmin()
    {
        $commandes = Commande::where('statut', '!=', 'en_panier')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.commandes.index', compact('commandes'));
    }
    
    public function showAdmin($id)
    {
        $commande = Commande::with('livres')->findOrFail($id);
        return view('admin.commandes.show', compact('commande'));
    }
    
    public function indexEmploye()
    {
        $commandes = Commande::where('statut', '!=', 'en_panier')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('employe.commandes.index', compact('commandes'));
    }
    
    public function showEmploye($id)
    {
        $commande = Commande::with('livres')->findOrFail($id);
        return view('employe.commandes.show', compact('commande'));
    }
    
    public function valider($id)
    {
        Commande::findOrFail($id)->update(['statut' => 'validee']);
        return back()->with('success', 'Commande validée');
    }
    
    public function annuler($id)
    {
        Commande::findOrFail($id)->update(['statut' => 'annulee']);
        return back()->with('success', 'Commande annulée');
    }
    
    // ================= COMMANDES CLIENT =================
    
    public function mesCommandes()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Veuillez vous connecter pour voir vos commandes.');
        }
        
        $commandes = Commande::where('user_id', Auth::id())
            ->where('statut', '!=', 'en_panier')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('client.commandes.index', compact('commandes'));
    }
    
    public function showClient($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $commande = Commande::with('livres')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
            
        return view('client.commandes.show', compact('commande'));
    }
}