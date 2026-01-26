<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    
    protected $fillable = ['user_id', 'livre_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function livre()
    {
        return $this->belongsTo(Livre::class, 'livre_id', 'id_livre');
    }
}