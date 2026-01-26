<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'user_id',
        'nom_client',
        'email',
        'telephone',
        'adresse',
        'total',
        'statut',
        'mode_paiement',
        'session_id',
        'reference',
        'stripe_session_id',
        'payment_status'
    ];

    public function livres()
    {
        return $this->belongsToMany(Livre::class, 'commande_livre', 'commande_id', 'livre_id')
                    ->withPivot('quantite', 'prix');
    }

    // Relation avec l'utilisateur (si connecté)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // NOUVELLE MÉTHODE: Pour créer un panier (commande avec statut 'panier')
    public static function getPanier($user_id = null, $session_id = null)
    {
        return self::where('statut', 'panier')
                   ->when($user_id, function($query) use ($user_id) {
                       return $query->where('user_id', $user_id);
                   })
                   ->when($session_id, function($query) use ($session_id) {
                       return $query->where('session_id', $session_id);
                   })
                   ->first();
    }
}
