<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categ';
    protected $fillable = [
        'nom_categ',
        'description_categ',
        'type_categ'
    ];

    public function livres()
    {
        return $this->belongsToMany(Livre::class, 'livres_categories', 'id_categ', 'id_livre');
    }
}