<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id('id_livre');
            $table->string('titre');
            $table->string('auteur');
            $table->string('editeur')->nullable();
            $table->date('annee_publication')->nullable();
            $table->string('categorie')->nullable();
            $table->decimal('prix', 10, 2);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};