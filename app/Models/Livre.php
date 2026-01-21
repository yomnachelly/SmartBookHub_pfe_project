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
        'image'
    ];

    protected $casts = [
        'annee_publication' => 'date',
        'prix' => 'decimal:2',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'livres_categories', 'id_livre', 'id_categ');
    }
}