<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_livre';
    protected $fillable = [
        'titre',
        'auteur',
        'editeur',
        'annee_publication',
        'categorie',
        'prix',
        'stock',
        'description',
        'image',
        'visible'
    ];

    protected $casts = [
        'annee_publication' => 'date',
        'prix' => 'decimal:2',
        'visible' => 'boolean'
    ];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'livres_categories', 'id_livre', 'id_categ');
    }
    
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_livre', 'livre_id', 'commande_id')
                    ->withPivot('quantite', 'prix');
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    public function scopeHidden($query)
    {
        return $query->where('visible', false);
    }
}