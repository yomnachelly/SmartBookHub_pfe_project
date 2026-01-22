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
    // ================= UTILITAIRES PANIER =================

    private function getPanierSession()
    {
        return Session::get('panier', []);
    }

    private function savePanierSession($panier)
    {
        Session::put('panier', $panier);
        Session::save();
    }

    private function calculerTotal()
    {
        $panier = $this->getPanierSession();
        $total = 0;

        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        return $total;
    }

    // ================= FORMULAIRE COMMANDE =================

    public function formulaire()
    {
        $panier = $this->getPanierSession();

        if (empty($panier)) {
            return redirect()->route('panier.index')
                ->with('error', 'Votre panier est vide');
        }

        return view('panier.formulaire', compact('panier'));
    }

    public function creerCommande(Request $request)
    {
        $panier = $this->getPanierSession();

        if (empty($panier)) {
            return redirect()->route('panier.index')
                ->with('error', 'Votre panier est vide');
        }

        $commande = Commande::create([
            'user_id'       => Auth::id(),
            'nom_client'    => $request->nom_client,
            'email'         => $request->email,
            'telephone'     => $request->telephone,
            'adresse'       => $request->adresse,
            'mode_paiement' => $request->mode_paiement,
            'total'         => $this->calculerTotal(),
            'statut'        => 'en_attente',
        ]);

        foreach ($panier as $item) {
            DB::table('commande_livre')->insert([
                'commande_id' => $commande->id,
                'livre_id'    => $item['livre_id'],
                'quantite'    => $item['quantite'],
                'prix'        => $item['prix'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $this->savePanierSession([]);
        Session::put('derniere_commande_id', $commande->id);

        return redirect()->route('commande.confirmation');
    }

    public function confirmation()
    {
        $commandeId = Session::get('derniere_commande_id');
        $commande = $commandeId ? Commande::find($commandeId) : null;

        return view('panier.confirmation', compact('commande'));

    }

    // ================= PANIER =================

    public function ajouterAuPanier($livre_id)
    {
        $livre = Livre::findOrFail($livre_id);
        $panier = $this->getPanierSession();

        if (isset($panier[$livre_id])) {
            $panier[$livre_id]['quantite'] += 1;
        } else {
            $panier[$livre_id] = [
                'livre_id' => $livre_id,
                'quantite' => 1,
                'prix'     => $livre->prix,
                'titre'    => $livre->titre,
                'auteur'   => $livre->auteur,
                'image'    => $livre->image,
            ];
        }

        $this->savePanierSession($panier);

        return back()->with('success', 'Livre ajouté au panier');
    }

    public function panier()
{
    $panier = $this->getPanierSession();
    $items = [];
    $total = 0;

    // Récupérer tous les livres du panier en une seule requête pour éviter trop de requêtes
    $livres = Livre::whereIn('id_livre', array_column($panier, 'livre_id'))
                   ->get()
                   ->keyBy('id_livre'); // clé = id_livre pour accès rapide

    foreach ($panier as $item) {
        // Vérifier si le livre existe toujours
        $livreStock = isset($livres[$item['livre_id']]) ? $livres[$item['livre_id']]->stock : 0;

        $sousTotal = $item['quantite'] * $item['prix'];
        $total += $sousTotal;

        $items[] = (object) [
            'id_livre'   => $item['livre_id'],
            'titre'      => $item['titre'],
            'auteur'     => $item['auteur'],
            'prix'       => $item['prix'],
            'image'      => $item['image'],
            'quantite'   => $item['quantite'],
            'sous_total' => $sousTotal,
            'stock'      => $livreStock, // stock correct
        ];
    }

    return view('panier.index', [
        'items'      => collect($items),
        'total'      => $total,
        'panierVide' => empty($panier),
    ]);
}
public function viderPanier()
{
    // Vider le panier stocké en session
    $this->savePanierSession([]);

    return redirect()->route('panier.index')->with('success', 'Panier vidé avec succès !');
}

    public function retirerDuPanier($livre_id)
    {
        $panier = $this->getPanierSession();

        if (isset($panier[$livre_id])) {
            unset($panier[$livre_id]);
            $this->savePanierSession($panier);
        }

        return redirect()->route('panier.index');
    }

    public function majQuantite(Request $request, $livre_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $panier = $this->getPanierSession();

        if (isset($panier[$livre_id])) {
            $panier[$livre_id]['quantite'] = $request->quantite;
            $this->savePanierSession($panier);
        }

        return redirect()->route('panier.index');
    }

    // ================= COMMANDES CLIENT =================

    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.commandes.index', compact('commandes'));
    }

    public function showClient($id)
    {
        $commande = Commande::with('livres')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('client.commandes.show', compact('commande'));
    }

    // ================= ADMIN / EMPLOYÉ =================

    public function indexAdmin()
    {
        $commandes = Commande::orderBy('created_at', 'desc')->get();
        return view('admin.commandes.index', compact('commandes'));
    }

    public function showAdmin($id)
    {
        $commande = Commande::with('livres')->findOrFail($id);
        return view('admin.commandes.show', compact('commande'));
    }

    public function valider($id)
    {
        Commande::findOrFail($id)->update(['statut' => 'validee']);
        return back();
    }

    public function annuler($id)
    {
        Commande::findOrFail($id)->update(['statut' => 'annulee']);
        return back();
    }
}
