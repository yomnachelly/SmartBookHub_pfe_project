<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Commande;

class StripeController extends Controller
{
    public function checkout(Commande $commande)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Conversion TND -> USD (Stripe ne supporte pas TND)
        $tauxChange = 0.32; // Exemple : 1 TND = 0.32 USD
        $montantUSD = round($commande->total * $tauxChange, 2);
        $montantStripe = (int)($montantUSD * 100); // en centimes

        // Créer session Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd', // Stripe gère USD
                    'product_data' => [
                        'name' => 'Commande #' . $commande->id,
                        'description' => "{$commande->total} TND", // Affiche TND pour l’utilisateur
                    ],
                    'unit_amount' => $montantStripe,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
            'metadata' => [
                'commande_id' => $commande->id,
                'montant_tnd' => $commande->total,
                'montant_usd' => $montantUSD,
                'taux_change' => $tauxChange,
            ]
        ]);

        // Enregistrer l'ID de session dans la commande
        $commande->update([
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
