<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Livre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Log;

class PanierController extends Controller
{
    private function getOrCreatePanier()
    {
        $session_id = session()->getId();
        
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
        
        return $panier;
    }
    
    public function ajouter($livre_id)
    {
        $livre = Livre::findOrFail($livre_id);
        
        if ($livre->stock < 1) {
            return redirect()->back()->with('error', 'Ce livre est en rupture de stock.');
        }
        
        $panier = $this->getOrCreatePanier();
        
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
        
        $this->updatePanierTotal($panier);
        
        return redirect()->back()->with('success', 'Livre ajouté au panier!');
    }
    
    public function index()
    {
        $panier = $this->getOrCreatePanier();
        
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
    
    public function majQuantite(Request $request, $livre_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);
        
        $panier = $this->getOrCreatePanier();
        
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
    
    public function vider()
    {
        $panier = $this->getOrCreatePanier();
        
        DB::table('commande_livre')
            ->where('commande_id', $panier->id)
            ->delete();
        
        $panier->update(['total' => 0]);
        
        return redirect()->route('panier.index')->with('success', 'Panier vidé!');
    }
    
    private function updatePanierTotal($panier)
    {
        $total = DB::table('commande_livre')
                  ->where('commande_id', $panier->id)
                  ->selectRaw('SUM(quantite * prix) as total')
                  ->value('total') ?? 0;
        
        $panier->update(['total' => $total]);
    }
    
    public function formulaireCommande()
    {
        $panier = $this->getOrCreatePanier();
        
        $itemsCount = DB::table('commande_livre')
                    ->where('commande_id', $panier->id)
                    ->count();
        
        if ($itemsCount == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        $items = DB::table('commande_livre as cl')
                ->join('livres as l', 'cl.livre_id', '=', 'l.id_livre')
                ->where('cl.commande_id', $panier->id)
                ->select('l.titre', 'l.prix', 'cl.quantite', 'cl.prix as prix_unitaire')
                ->get();
        
        $total = $items->sum(function($item) {
            return $item->quantite * $item->prix_unitaire;
        });
        
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
            'items' => $items,
            'total' => $total,
            'userData' => $userData
        ]);
    }
    
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
        
        $itemsCount = DB::table('commande_livre')
                    ->where('commande_id', $panier->id)
                    ->count();
        
        if ($itemsCount == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide!');
        }
        
        $livres = DB::table('commande_livre as cl')
                ->join('livres as l', 'cl.livre_id', '=', 'l.id_livre')
                ->where('cl.commande_id', $panier->id)
                ->select('l.id_livre', 'l.titre', 'l.stock', 'cl.quantite')
                ->get();
        
        foreach ($livres as $livre) {
            if ($livre->stock < $livre->quantite) {
                return redirect()->back()->with('error', 
                    "Stock insuffisant pour '{$livre->titre}'. Disponible: {$livre->stock}");
            }
        }
        
        $reference = 'CMD-' . strtoupper(Str::random(8));
        
        $panier->update([
            'nom_client' => $request->nom_client,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'mode_paiement' => $request->mode_paiement,
            'statut' => 'en_attente',
            'reference' => $reference
        ]);
        
        if (Auth::check() && !$panier->user_id) {
            $panier->update(['user_id' => Auth::id()]);
        }
        
        foreach ($livres as $livre) {
            DB::table('livres')
                ->where('id_livre', $livre->id_livre)
                ->decrement('stock', $livre->quantite);
        }
        
        try {
            $commande = Commande::with('livres')->find($panier->id);
            
            Mail::to($commande->email)->send(new InvoiceMail($commande));
            
            Log::info('Invoice email sent for order #' . $commande->id . ' to ' . $commande->email);
            
            session()->flash('invoice_sent', true);
            session()->flash('customer_email', $commande->email);
            
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email: ' . $e->getMessage());
            
            session()->flash('invoice_sent', false);
            session()->flash('email_error', $e->getMessage());
        }
        
        if (Auth::check()) {
            Commande::create([
                'user_id' => Auth::id(),
                'session_id' => session()->getId(),
                'statut' => 'panier',
                'total' => 0
            ]);
        }
        
        session()->put('last_order_id', $panier->id);
        session()->put('last_order_session', session()->getId());
        
        return redirect()->route('commande.confirmation', ['id' => $panier->id])
                        ->with('success', 'Commande passée avec succès! Un email de confirmation vous a été envoyé.');
    }
    
    public function confirmation($id)
    {
        $commande = Commande::findOrFail($id);
        
        $canAccess = false;
        
        if (Auth::check() && $commande->user_id && $commande->user_id === Auth::id()) {
            $canAccess = true;
        }
        
        if (!$canAccess && session('last_order_id') == $id && session('last_order_session') == session()->getId()) {
            $canAccess = true;
        }
        
        if (!$canAccess && !$commande->user_id && $commande->session_id === session()->getId()) {
            $canAccess = true;
        }
        
        if (!$canAccess) {
            abort(403, 'Unauthorized access to this order');
        }
        
        $livres = DB::table('commande_livre as cl')
                ->join('livres as l', 'cl.livre_id', '=', 'l.id_livre')
                ->where('cl.commande_id', $commande->id)
                ->select('l.*', 'cl.quantite', 'cl.prix')
                ->get()
                ->map(function($livre) {
                    $livre->pivot = (object)[
                        'quantite' => $livre->quantite,
                        'prix' => $livre->prix
                    ];
                    return $livre;
                });
        
        $commande->livres = $livres;
        
        $invoiceSent = session('invoice_sent', false);
        $customerEmail = session('customer_email', $commande->email);
        $emailError = session('email_error');
        
        return view('panier.confirmation', [
            'commande' => $commande,
            'invoiceSent' => $invoiceSent,
            'customerEmail' => $customerEmail,
            'emailError' => $emailError
        ]);
    }
}