<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Commande;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function checkout(Commande $commande)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // conversion TND -> USD
        $tauxChange = 0.32;
        $montantUSD = round($commande->total * $tauxChange, 2);
        $montantStripe = (int)($montantUSD * 100);

        // creation de session Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Commande #' . $commande->id,
                        'description' => "{$commande->total} TND",
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

        $commande->update([
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $sessionId = request()->query('session_id');
        $commande = null;
        $invoiceSent = null;
        $emailError = null;

        if ($sessionId) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                $session = Session::retrieve($sessionId);

                if (isset($session->metadata->commande_id)) {
                    $commande = Commande::find($session->metadata->commande_id);

                    if ($commande && $session->payment_status === 'paid') {
                        $commande->update([
                            'statut' => 'validee',
                            'stripe_payment_intent' => $session->payment_intent ?? null,
                        ]);

                        try {
                            Mail::to($commande->email)->send(new InvoiceMail($commande));
                            $invoiceSent = true;
                            Log::info('Facture envoyée après paiement réussi pour la commande #' . $commande->id);
                        } catch (\Exception $e) {
                            $invoiceSent = false;
                            $emailError = $e->getMessage();
                            Log::error('Erreur lors de l\'envoi de la facture: ' . $e->getMessage());
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('Erreur lors de la récupération de la session Stripe: ' . $e->getMessage());
            }
        }

        return view('stripe.success', compact('commande', 'invoiceSent', 'emailError'));
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}