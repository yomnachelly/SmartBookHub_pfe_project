<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('commande_livre', function (Blueprint $table) {
    $table->id();
    $table->foreignId('commande_id')->constrained()->onDelete('cascade');
    
    // Pour livre_id, préciser la colonne référencée
    $table->unsignedBigInteger('livre_id');
    $table->foreign('livre_id')
          ->references('id_livre')
          ->on('livres')
          ->onDelete('cascade');

    $table->integer('quantite');
    $table->double('prix');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_livre');
    }
};
